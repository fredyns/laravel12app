<?php
return [
    "migrationPrefix" => "2025_04_29_075641",
    "name" => "user_galleries",
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
            "comment" => "#image:jpg,jpeg,png",
            "config" => [
                "image" => "jpg,jpeg,png",
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
            "name" => "fk_user_galleries_users",
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
            "name" => "fk_user_galleries_users",
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
    "lang.en" => [
        "name" => "User Galleries",
        "index_title" => "User Galleries List",
        "new_title" => "New User Gallery",
        "create_title" => "Add User Gallery",
        "edit_title" => "Edit User Gallery",
        "show_title" => "Show User Gallery",
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
        "name" => "User Galleries",
        "index_title" => "Tabel User Galleries",
        "new_title" => "Tambah User Gallery",
        "create_title" => "Tambah User Gallery",
        "edit_title" => "Edit User Gallery",
        "show_title" => "Lihat User Gallery",
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
    "modelName" => "UserGallery",
    "route" => "user-galleries",
    "controllerName" => "UserGalleryController",
    "viewFolder" => "user_galleries",
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
            "name",
            "type",
        ],
    ],
    "action.create" => [
        "type" => "create",
        "uploadPath" => "user_galleries/{year}/{id}",
        "rules" => [
            [
                "required",
            ],
            [
                "required",
            ],
            [
                "required",
                "uuid",
                "exists:users,id",
            ],
            [
                "required",
                "string",
                "image",
                "extensions:jpg,png",
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
            ],
            [
                "nullable",
            ],
        ],
        "sections" => [
            "general" => [
                "title" => "User Gallery",
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
                        "type" => "image",
                        "config" => [
                            "image" => "jpg,jpeg,png",
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
        "uploadPath" => "user_galleries/{year}/{id}",
        "rules" => [
            [
                "required",
            ],
            [
                "required",
            ],
            [
                "required",
                "uuid",
                "exists:users,id",
            ],
            [
                "required",
                "string",
                "image",
                "extensions:jpg,png",
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
            ],
            [
                "nullable",
            ],
        ],
        "sections" => [
            "general" => [
                "title" => "User Gallery",
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
                        "type" => "image",
                        "config" => [
                            "image" => "jpg,jpeg,png",
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
                "title" => "User Gallery",
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