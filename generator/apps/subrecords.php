<?php
return [
    "name" => "subrecords",
    "columns" => [
        [
            "name" => "id",
            "type" => "BINARY",
            "nullable" => FALSE,
            "default" => "(UUID_TO_BIN(UUID()))",
        ],
        [
            "name" => "records_id",
            "type" => "BINARY",
            "nullable" => FALSE,
            "default" => NULL,
            "comment" => "#uuid",
            "config" => [
                "uuid" => TRUE,
            ],
        ],
        [
            "name" => "datetime",
            "type" => "DATETIME",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        [
            "name" => "date",
            "type" => "DATE",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        [
            "name" => "time",
            "type" => "TIME",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        [
            "name" => "n_p_w_p",
            "type" => "BIGINT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#npwp",
            "config" => [
                "npwp" => TRUE,
            ],
        ],
        [
            "name" => "markdown_text",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#markdown",
            "config" => [
                "markdown" => TRUE,
            ],
        ],
        [
            "name" => "w_y_s_i_w_y_g",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#wysiwyg",
            "config" => [
                "wysiwyg" => TRUE,
            ],
        ],
        [
            "name" => "file",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#file",
            "config" => [
                "file" => TRUE,
            ],
        ],
        [
            "name" => "image",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#image:jpg,jpeg,png",
            "config" => [
                "image" => "jpg,jpeg,png",
            ],
        ],
        [
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
        [
            "name" => "latitude",
            "type" => "DECIMAL",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        [
            "name" => "longitude",
            "type" => "DECIMAL",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        [
            "name" => "created_at",
            "type" => "TIMESTAMP",
            "nullable" => TRUE,
            "default" => "NOW()",
        ],
        [
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
    "faker" => [
        "id" => NULL,
        "records_id" => "uuid()",
        "datetime" => "dateTimeThisDecade()",
        "date" => "dateTimeThisDecade()",
        "time" => "time()",
        "n_p_w_p" => "randomNumber(5, true)",
        "markdown_text" => "paragraph()",
        "w_y_s_i_w_y_g" => "randomHtml()",
        "file" => NULL,
        "image" => NULL,
        "i_p_address" => "localIpv4()",
        "latitude" => "randomFloat(5, true)",
        "longitude" => "randomFloat(5, true)",
        "created_at" => NULL,
        "updated_at" => NULL,
    ],
    "seeder" => 10,
    "modelName" => "Subrecords",
    "route" => "subrecords",
    "controllerName" => "SubrecordsController",
    "viewFolder" => "subrecords",
    "index" => [
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
    "form" => [
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
        "uploadPath" => "subrecords",
        "rules" => [],
    ],
    "show" => [
        "cards" => [
            "general" => [
                "title" => "Model",
                "fields" => [
                    "field-name" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                ],
            ],
        ],
    ],
    "policy" => [
        "viewAny" => "table.index",
        "view" => "table.show",
        "create" => "table.create",
        "update" => "table.update",
        "delete" => "table.delete",
        "deleteAny" => "table.delete",
        "restore" => FALSE,
        "forceDelete" => FALSE,
    ],
    "lang" => [
        "name" => "Records",
        "index_title" => "Records List",
        "new_title" => "New Record",
        "create_title" => "Create Record",
        "edit_title" => "Edit Record",
        "show_title" => "Show Record",
        "columns" => [
            "user_id" => "User",
            "string" => "String",
        ],
        "fields" => [
            "user_id" => "User",
            "string" => "String",
        ],
    ],
];
