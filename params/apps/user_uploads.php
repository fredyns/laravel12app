<?php
return [
    "migrationPrefix" => "2025_04_29_075641",
    "name" => "user_uploads",
    "columns" => [
        "id" => [
            "name" => "id",
            "type" => "BINARY",
            "nullable" => FALSE,
            "default" => "(UUID_TO_BIN(UUID()))",
        ],
        "at" => [
            "name" => "at",
            "type" => "TIMESTAMP",
            "nullable" => FALSE,
            "default" => NULL,
        ],
        "user_id" => [
            "name" => "user_id",
            "type" => "BINARY",
            "nullable" => FALSE,
            "default" => NULL,
            "comment" => "#uuid",
            "config" => [
                "uuid" => TRUE,
            ],
        ],
        "file" => [
            "name" => "file",
            "type" => "TEXT",
            "nullable" => FALSE,
            "default" => NULL,
            "comment" => "#file",
            "config" => [
                "file" => TRUE,
            ],
        ],
        "name" => [
            "name" => "name",
            "type" => "VARCHAR",
            "nullable" => TRUE,
            "default" => NULL,
            "length" => 255,
        ],
        "description" => [
            "name" => "description",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        "type" => [
            "name" => "type",
            "type" => "VARCHAR",
            "nullable" => TRUE,
            "default" => NULL,
            "length" => 255,
        ],
        "metadata" => [
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
            "columns" => ["id"],
            "unique" => 0,
        ],
        [
            "name" => "at",
            "columns" => ["at"],
            "unique" => 0,
        ],
        [
            "name" => "fk_user_uploads_users",
            "columns" => ["user_id"],
            "unique" => 0,
        ],
    ],
    "primaryKey" => [
        "name" => "PRIMARY",
        "columns" => ["id"],
    ],
    "lang.en" => [
        "name" => "User Uploads",
        "index_title" => "User Uploads List",
        "new_title" => "New User Upload",
        "create_title" => "Add User Upload",
        "edit_title" => "Edit User Upload",
        "show_title" => "Show User Upload",
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
        "name" => "User Uploads",
        "index_title" => "Tabel User Uploads",
        "new_title" => "Tambah User Upload",
        "create_title" => "Tambah User Upload",
        "edit_title" => "Edit User Upload",
        "show_title" => "Lihat User Upload",
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
        "at" => NULL,
        "user_id" => "uuid()",
        "file" => NULL,
        "name" => "firstName()",
        "description" => "text(5)",
        "type" => "word()",
        "metadata" => NULL,
    ],
    "seeder" => 10,
    "modelName" => "UserUpload",
    "route" => "user-uploads",
    "controllerName" => "UserUploadController",
    "viewFolder" => "user_uploads",
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
        "columns" => ["name", "type"],
    ],
    "action.create" => [
        "type" => "create",
        "uploadPath" => "user_uploads/{year}/{id}",
        "rules" => [
            ["required"],
            ["required"],
            ["required", "uuid", "exists:users,id"],
            ["required",
                "string",
                "file",
                "extensions:pdf,docx,xlsx,pptx,jpg,png,zip,rar"],
            ["nullable", "string"],
            ["nullable", "string"],
            ["nullable", "string"],
            ["nullable"],
        ],
        "sections" => [
            "general" => [
                "title" => "User Upload",
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
            ],
        ],
    ],
    "action.update" => [
        "type" => "update",
        "uploadPath" => "user_uploads/{year}/{id}",
        "rules" => [
            ["required"],
            ["required"],
            ["required", "uuid", "exists:users,id"],
            ["required",
                "string",
                "file",
                "extensions:pdf,docx,xlsx,pptx,jpg,png,zip,rar"],
            ["nullable", "string"],
            ["nullable", "string"],
            ["nullable", "string"],
            ["nullable"],
        ],
        "sections" => [
            "general" => [
                "title" => "User Upload",
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
            ],
        ],
    ],
    "action.show" => [
        "type" => "show",
        "sections" => [
            "general" => [
                "title" => "User Upload",
                "fields" => [
                    "id" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "at" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "user_id" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "file" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "name" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "description" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "type" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "metadata" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                ],
            ],
        ],
    ],
];
