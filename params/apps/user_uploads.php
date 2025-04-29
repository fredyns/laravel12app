<?php
return [
    "name" => "user_uploads",
    "columns" => [
        [
            "name" => "id",
            "type" => "BINARY",
            "nullable" => FALSE,
            "default" => "(UUID_TO_BIN(UUID()))",
        ],
        [
            "name" => "at",
            "type" => "TIMESTAMP",
            "nullable" => FALSE,
            "default" => NULL,
        ],
        [
            "name" => "user_id",
            "type" => "BINARY",
            "nullable" => FALSE,
            "default" => NULL,
            "comment" => "#uuid",
            "config" => [
                "uuid" => TRUE,
            ],
        ],
        [
            "name" => "file",
            "type" => "TEXT",
            "nullable" => FALSE,
            "default" => NULL,
            "comment" => "#file",
            "config" => [
                "file" => TRUE,
            ],
        ],
        [
            "name" => "name",
            "type" => "VARCHAR",
            "nullable" => TRUE,
            "default" => NULL,
            "length" => 255,
        ],
        [
            "name" => "description",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        [
            "name" => "type",
            "type" => "VARCHAR",
            "nullable" => TRUE,
            "default" => NULL,
            "length" => 255,
        ],
        [
            "name" => "metadata",
            "type" => "JSON",
            "nullable" => TRUE,
            "default" => NULL,
        ],
    ],
    "foreignKeys" => [
        "user_id" => [
            "name" => "fk_user_uploads_users",
            "column" => "user_id",
            "referenced_table" => "users",
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
            "name" => "at",
            "columns" => [
                "at",
            ],
            "unique" => 0,
        ],
        [
            "name" => "fk_user_uploads_users",
            "columns" => [
                "user_id",
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
        "at" => NULL,
        "user_id" => "uuid()",
        "file" => NULL,
        "name" => "firstName()",
        "description" => "text(5)",
        "type" => "word()",
        "metadata" => NULL,
    ],
    "seeder" => 10,
    "modelName" => "UserUploads",
    "route" => "user-uploads",
    "controllerName" => "UserUploadsController",
    "viewFolder" => "user_uploads",
    "index" => [
        "paginate" => 10,
        "columns" => [
            "name",
            "type",
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
            "at" => [
                "type" => "text",
                "config" => [
                    "required" => TRUE,
                ],
                "col" => "full",
                "col-md" => "full",
                "col-lg" => "full",
            ],
            "user_id" => [
                "type" => "select",
                "config" => [
                    "model" => "App\\Models\\Users",
                    "key" => "id",
                    "label" => "name",
                    "required" => TRUE,
                ],
                "col" => "full",
                "col-md" => "full",
                "col-lg" => "full",
            ],
            "file" => [
                "type" => "file",
                "config" => [
                    "required" => TRUE,
                ],
                "col" => "full",
                "col-md" => "full",
                "col-lg" => "full",
            ],
            "name" => [
                "type" => "text",
                "col" => "full",
                "col-md" => "full",
                "col-lg" => "full",
            ],
            "description" => [
                "type" => "textarea",
                "col" => "full",
                "col-md" => "full",
                "col-lg" => "full",
            ],
            "type" => [
                "type" => "text",
                "col" => "full",
                "col-md" => "full",
                "col-lg" => "full",
            ],
            "metadata" => [
                "type" => "text",
                "col" => "full",
                "col-md" => "full",
                "col-lg" => "full",
            ],
        ],
        "uploadPath" => "user_uploads",
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
