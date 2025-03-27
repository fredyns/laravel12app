import grt
import json
import re
import os
import platform
import ctypes

def parse_comment(comment):
    config = {}
    if comment:
        # Find all key-value pairs or single key entries in the comment
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
    # Get columns information
    columns = [get_column_info(col) for col in table.columns]

    # Get foreign keys information
    foreign_keys = [{
        "name": fk.name,
        "column": fk.columns[0].name,
        "referenced_table": fk.referencedTable.name,
        "referenced_column": fk.referencedColumns[0].name
    } for fk in table.foreignKeys]

    # Get indices information
    indices = [{
        "name": idx.name,
        "columns": [col.referencedColumn.name for col in idx.columns],
        "unique": idx.unique
    } for idx in table.indices]

    # Get primary key information
    primary_key = {
        "name": table.primaryKey.name,
        "columns": [col.referencedColumn.name for col in table.primaryKey.columns]
    } if table.primaryKey else None

    # Build the table information dictionary
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

def export_tables_info_to_json(output_file):
    # Get the schema
    schema = grt.root.wb.doc.physicalModels[0].catalog.schemata[0]

    tables_info = []
    for table in schema.tables:
        table_info = get_table_info(table)
        tables_info.append(table_info)

    # Save the tables information as JSON
    with open(output_file, 'w') as f:
        json.dump(tables_info, f, indent=4)

    # Show an alert with the output file path based on the OS type
    print(f"Output file saved to: {output_file}")

    if platform.system() == "Windows":
        ctypes.windll.user32.MessageBoxW(0, f"Output file saved to:\n{output_file}", "Export Complete", 0)

if __name__ == "__main__":
    # Set the output file to the same directory as the script
    script_dir = os.path.dirname(os.path.realpath(__file__))
    output_file = os.path.join(script_dir, "table_definitions.json")
    export_tables_info_to_json(output_file)
