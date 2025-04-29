<?php
return [
    "migrationPrefix" => "2025_04_29_075641",
    "name" => "subrecords",
    "columns" => [
        "id" => [
            "name" => "id",
            "type" => "BINARY",
            "nullable" => FALSE,
            "default" => "(UUID_TO_BIN(UUID()))",
        ],
        "records_id" => [
            "name" => "records_id",
            "type" => "BINARY",
            "nullable" => FALSE,
            "default" => NULL,
            "comment" => "#uuid",
            "config" => [
                "uuid" => TRUE,
            ],
        ],
        "datetime" => [
            "name" => "datetime",
            "type" => "DATETIME",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        "date" => [
            "name" => "date",
            "type" => "DATE",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        "time" => [
            "name" => "time",
            "type" => "TIME",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        "n_p_w_p" => [
            "name" => "n_p_w_p",
            "type" => "BIGINT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#npwp",
            "config" => [
                "npwp" => TRUE,
            ],
        ],
        "markdown_text" => [
            "name" => "markdown_text",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#markdown",
            "config" => [
                "markdown" => TRUE,
            ],
        ],
        "w_y_s_i_w_y_g" => [
            "name" => "w_y_s_i_w_y_g",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#wysiwyg",
            "config" => [
                "wysiwyg" => TRUE,
            ],
        ],
        "file" => [
            "name" => "file",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#file",
            "config" => [
                "file" => TRUE,
            ],
        ],
        "image" => [
            "name" => "image",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#image:jpg,jpeg,png",
            "config" => [
                "image" => "jpg,jpeg,png",
            ],
        ],
        "i_p_address" => [
            "name" => "i_p_address",
            "type" => "VARCHAR",
            "nullable" => TRUE,
            "default" => NULL,
            "length" => 255,
            "comment" => "#ipaddress",
            "config" => [
                "ipaddress" => TRUE,
            ],
        ],
        "latitude" => [
            "name" => "latitude",
            "type" => "DECIMAL",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        "longitude" => [
            "name" => "longitude",
            "type" => "DECIMAL",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        "created_at" => [
            "name" => "created_at",
            "type" => "TIMESTAMP",
            "nullable" => TRUE,
            "default" => "NOW()",
        ],
        "updated_at" => [
            "name" => "updated_at",
            "type" => "TIMESTAMP",
            "nullable" => TRUE,
            "default" => NULL,
        ],
    ],
    "foreignKeys" => [
        "records_id" => [
            "name" => "fk_subrecords_records",
            "column" => "records_id",
            "referenced_table" => "records",
            "referenced_column" => "id",
        ],
    ],
    "indices" => [
        [
            "name" => "PRIMARY",
            "columns" => [
                "id",
            ],
            "unique" => 0,
        ],
        [
            "name" => "created_at",
            "columns" => [
                "created_at",
            ],
            "unique" => 0,
        ],
        [
            "name" => "fk_subrecords_records",
            "columns" => [
                "records_id",
            ],
            "unique" => 0,
        ],
    ],
    "primaryKey" => [
        "name" => "PRIMARY",
        "columns" => [
            "id",
        ],
    ],
    "lang.en" => [
        "name" => "Subrecords",
        "index_title" => "Subrecords List",
        "new_title" => "New Subrecord",
        "create_title" => "Add Subrecord",
        "edit_title" => "Edit Subrecord",
        "show_title" => "Show Subrecord",
        "columns" => [
            "user_id" => "User",
            "string" => "String",
        ],
        "fields" => [
            "user_id" => "User",
            "string" => "String",
        ],
    ],
    "lang.id" => [
        "name" => "Subrecords",
        "index_title" => "Tabel Subrecords",
        "new_title" => "Tambah Subrecord",
        "create_title" => "Tambah Subrecord",
        "edit_title" => "Edit Subrecord",
        "show_title" => "Lihat Subrecord",
        "columns" => [
            "user_id" => "User",
            "string" => "String",
        ],
        "fields" => [
            "user_id" => "User",
            "string" => "String",
        ],
    ],
    "faker" => [
        "id" => NULL,
        "records_id" => "uuid()",
        "datetime" => "dateTimeThisDecade()",
        "date" => "dateTimeThisDecade()",
        "time" => "time()",
        "n_p_w_p" => "randomNumber(15, true)",
        "markdown_text" => "paragraph()",
        "w_y_s_i_w_y_g" => "randomHtml()",
        "file" => NULL,
        "image" => NULL,
        "i_p_address" => "localIpv4()",
        "latitude" => "randomFloat()",
        "longitude" => "randomFloat()",
        "created_at" => NULL,
        "updated_at" => NULL,
    ],
    "seeder" => 10,
    "modelName" => "Subrecord",
    "route" => "subrecords",
    "controllerName" => "SubrecordController",
    "viewFolder" => "subrecords",
    "policy" => [
        "index" => "table.index",
        "view" => "table.show",
        "create" => "table.create",
        "update" => "table.update",
        "delete" => "table.delete",
        "restore" => FALSE,
        "forceDelete" => FALSE,
    ],
    "action.index" => [
        "type" => "index",
        "paginate" => 10,
        "columns" => [
            "datetime",
            "date",
            "time",
            "n_p_w_p",
            "i_p_address",
            "latitude",
            "longitude",
        ],
    ],
    "action.create" => [
        "type" => "create",
        "uploadPath" => "subrecords/{year}/{id}",
        "rules" => [
            [
                "required",
            ],
            [
                "required",
                "uuid",
                "exists:records,id",
            ],
            [
                "nullable",
                "date",
            ],
            [
                "nullable",
            ],
            [
                "nullable",
                "date_format:H:i",
            ],
            [
                "nullable",
                "numeric",
            ],
            [
                "nullable",
                "string",
            ],
            [
                "nullable",
                "string",
            ],
            [
                "nullable",
                "string",
                "file",
                "extensions:pdf,docx,xlsx,pptx,jpg,png,zip,rar",
            ],
            [
                "nullable",
                "string",
                "image",
                "extensions:jpg,png",
            ],
            [
                "nullable",
                "string",
                "ip",
            ],
            [
                "nullable",
                "numeric",
            ],
            [
                "nullable",
                "numeric",
            ],
            [
                "nullable",
            ],
            [
                "nullable",
            ],
        ],
        "sections" => [
            "general" => [
                "title" => "Subrecord",
                "fields" => [
                    "id" => [
                        "type" => "text",
                        "config" => [
                            "required" => TRUE,
                        ],
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "records_id" => [
                        "type" => "select",
                        "config" => [
                            "model" => "App\\Models\\Records",
                            "key" => "id",
                            "label" => "email",
                            "required" => TRUE,
                        ],
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "datetime" => [
                        "type" => "datetime",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "date" => [
                        "type" => "date",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "time" => [
                        "type" => "time",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "n_p_w_p" => [
                        "type" => "npwp",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "markdown_text" => [
                        "type" => "markdown",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "w_y_s_i_w_y_g" => [
                        "type" => "wysiwyg",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "file" => [
                        "type" => "file",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "image" => [
                        "type" => "image",
                        "config" => [
                            "image" => "jpg,jpeg,png",
                        ],
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "i_p_address" => [
                        "type" => "ipaddress",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "latitude" => [
                        "type" => "number",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "longitude" => [
                        "type" => "number",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "created_at" => [
                        "type" => "text",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "updated_at" => [
                        "type" => "text",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                ],
            ],
        ],
    ],
    "action.update" => [
        "type" => "update",
        "uploadPath" => "subrecords/{year}/{id}",
        "rules" => [
            [
                "required",
            ],
            [
                "required",
                "uuid",
                "exists:records,id",
            ],
            [
                "nullable",
                "date",
            ],
            [
                "nullable",
            ],
            [
                "nullable",
                "date_format:H:i",
            ],
            [
                "nullable",
                "numeric",
            ],
            [
                "nullable",
                "string",
            ],
            [
                "nullable",
                "string",
            ],
            [
                "nullable",
                "string",
                "file",
                "extensions:pdf,docx,xlsx,pptx,jpg,png,zip,rar",
            ],
            [
                "nullable",
                "string",
                "image",
                "extensions:jpg,png",
            ],
            [
                "nullable",
                "string",
                "ip",
            ],
            [
                "nullable",
                "numeric",
            ],
            [
                "nullable",
                "numeric",
            ],
            [
                "nullable",
            ],
            [
                "nullable",
            ],
        ],
        "sections" => [
            "general" => [
                "title" => "Subrecord",
                "fields" => [
                    "id" => [
                        "type" => "text",
                        "config" => [
                            "required" => TRUE,
                        ],
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "records_id" => [
                        "type" => "select",
                        "config" => [
                            "model" => "App\\Models\\Records",
                            "key" => "id",
                            "label" => "email",
                            "required" => TRUE,
                        ],
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "datetime" => [
                        "type" => "datetime",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "date" => [
                        "type" => "date",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "time" => [
                        "type" => "time",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "n_p_w_p" => [
                        "type" => "npwp",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "markdown_text" => [
                        "type" => "markdown",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "w_y_s_i_w_y_g" => [
                        "type" => "wysiwyg",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "file" => [
                        "type" => "file",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "image" => [
                        "type" => "image",
                        "config" => [
                            "image" => "jpg,jpeg,png",
                        ],
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "i_p_address" => [
                        "type" => "ipaddress",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "latitude" => [
                        "type" => "number",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "longitude" => [
                        "type" => "number",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "created_at" => [
                        "type" => "text",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "updated_at" => [
                        "type" => "text",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                ],
            ],
        ],
    ],
    "action.show" => [
        "type" => "show",
        "sections" => [
            "general" => [
                "title" => "Subrecord",
                "fields" => [
                    "id" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "records_id" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "datetime" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "date" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "time" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "n_p_w_p" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "markdown_text" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "w_y_s_i_w_y_g" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "file" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "image" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "i_p_address" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "latitude" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "longitude" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "created_at" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "updated_at" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                ],
            ],
        ],
    ],
];