import grt
import re
import os
import platform
import ctypes

def parse_comment(comment):
    config = {}
    if comment:
        matches = re.findall(r"#(\w+)(?::([\w,]+))?", comment)
        for match in matches:
            key = match[0]
            value = match[1]
            if value:
                config[key] = value if ',' in value else int(value) if value.isdigit() else value
            else:
                config[key] = True
    return config

def get_column_info(col):
    column_info = {
        "name": col.name,
        "type": re.sub(r"\(\d+\)", "", col.formattedType),  # Remove length from type
        "nullable": col.isNotNull == 0,
        # Add default value to column_info and set it to None if defaultValue is empty or "NULL"
        "default": None if col.defaultValue in ["", "null", "NULL"] else col.defaultValue
    }
    if col.length > 0:
        column_info["length"] = col.length
    if col.precision > 0:
        column_info["precision"] = col.precision
    if col.scale > 0:
        column_info["scale"] = col.scale
    if col.comment:
        column_info["comment"] = col.comment
        column_info["config"] = parse_comment(col.comment)

    # Check if column type is ENUM, extract options, and remove them from type
    if col.formattedType.startswith("ENUM"):
        column_info["options"] = re.findall(r"'(.*?)'", col.formattedType)
        column_info["type"] = "ENUM"  # Set type to ENUM only, without the options

    return column_info

def get_table_info(table):
    columns = [get_column_info(col) for col in table.columns]

    foreign_keys = [{
        "name": fk.name,
        "column": fk.columns[0].name,
        "referenced_table": fk.referencedTable.name,
        "referenced_column": fk.referencedColumns[0].name
    } for fk in table.foreignKeys]

    indices = [{
        "name": idx.name,
        "columns": [col.referencedColumn.name for col in idx.columns],
        "unique": idx.unique
    } for idx in table.indices]

    primary_key = {
        "name": table.primaryKey.name,
        "columns": [col.referencedColumn.name for col in table.primaryKey.columns]
    } if table.primaryKey else None

    table_info = {
        "name": table.name,
        "columns": columns,
        "foreignKeys": foreign_keys,
        "indices": indices,
        "primaryKey": primary_key,
    }
    if table.comment:
        table_info["comment"] = table.comment

    return table_info

def convert_to_php_array(data, indent_level=1):
    indent = "    " * indent_level
    if isinstance(data, dict):
        items = []
        for key, value in data.items():
            items.append(f'{indent}"{key}" => {convert_to_php_array(value, indent_level + 1)}')
        return "[\n" + ",\n".join(items) + f'\n{"    " * (indent_level - 1)}]'
    elif isinstance(data, list):
        items = [f'{indent}{convert_to_php_array(item, indent_level + 1)}' for item in data]
        return "[\n" + ",\n".join(items) + f'\n{"    " * (indent_level - 1)}]'
    elif isinstance(data, str):
        return f'"{data}"'
    elif isinstance(data, bool):
        return "true" if data else "false"
    elif data is None:
        return "null"
    else:
        return str(data)

def export_table_info_to_php_array(table, output_dir):
    table_info = get_table_info(table)
    php_array = "<?php\n\nreturn " + convert_to_php_array(table_info) + ";\n"
    file_name = f"{table.name}.php"
    output_file = os.path.join(output_dir, file_name)

    with open(output_file, 'w') as f:
        f.write(php_array)

    print(f"PHP array for table '{table.name}' saved to: {output_file}")

if __name__ == "__main__":
    # Check if __file__ is defined and provide a fallback
    try:
        script_dir = os.path.dirname(os.path.realpath(__file__))
    except NameError:
        script_dir = os.getcwd()

    output_dir = os.path.join(script_dir, "..", "config", "tables")
    os.makedirs(output_dir, exist_ok=True)

    schema = grt.root.wb.doc.physicalModels[0].catalog.schemata[0]

    for table in schema.tables:
        # Skip these tables
        if table.name in ["template_for_table"]:
            continue

        export_table_info_to_php_array(table, output_dir)

    if platform.system() == "Windows":
        ctypes.windll.user32.MessageBoxW(0, f"PHP array for tables saved to:\n{output_dir}", "Export Complete", 0)
