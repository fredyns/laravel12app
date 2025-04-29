<?php
return [
    "migrationPrefix" => "2025_04_29_075641",
    "name" => "users",
    "columns" => [
        "id" => [
            "name" => "id",
            "type" => "BINARY",
            "nullable" => FALSE,
            "default" => "(UUID_TO_BIN(UUID()))",
        ],
        "created_at" => [
            "name" => "created_at",
            "type" => "TIMESTAMP",
            "nullable" => FALSE,
            "default" => "NOW()",
        ],
        "updated_at" => [
            "name" => "updated_at",
            "type" => "TIMESTAMP",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        "name" => [
            "name" => "name",
            "type" => "VARCHAR",
            "nullable" => TRUE,
            "default" => NULL,
            "length" => 255,
        ],
        "email" => [
            "name" => "email",
            "type" => "VARCHAR",
            "nullable" => TRUE,
            "default" => NULL,
            "length" => 255,
            "comment" => "#email",
            "config" => [
                "email" => TRUE,
            ],
        ],
        "email_verified_at" => [
            "name" => "email_verified_at",
            "type" => "TIMESTAMP",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        "password" => [
            "name" => "password",
            "type" => "VARCHAR",
            "nullable" => TRUE,
            "default" => NULL,
            "length" => 255,
            "comment" => "#secret",
            "config" => [
                "secret" => TRUE,
            ],
        ],
        "remember_token" => [
            "name" => "remember_token",
            "type" => "VARCHAR",
            "nullable" => TRUE,
            "default" => NULL,
            "length" => 255,
        ],
        "two_factor_secret" => [
            "name" => "two_factor_secret",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        "two_factor_recovery_codes" => [
            "name" => "two_factor_recovery_codes",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        "two_factor_confirmed_at" => [
            "name" => "two_factor_confirmed_at",
            "type" => "TIMESTAMP",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        "current_team_id" => [
            "name" => "current_team_id",
            "type" => "BIGINT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#uuid",
            "config" => [
                "uuid" => TRUE,
            ],
        ],
        "profile_photo_path" => [
            "name" => "profile_photo_path",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#image:jpg,jpeg,png",
            "config" => [
                "image" => "jpg,jpeg,png",
            ],
        ],
    ],
    "foreignKeys" => [],
    "indices" => [
        [
            "name" => "email_UNIQUE",
            "columns" => [
                "email",
            ],
            "unique" => 1,
        ],
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
    ],
    "primaryKey" => [
        "name" => "PRIMARY",
        "columns" => [
            "id",
        ],
    ],
    "lang.en" => [
        "name" => "Users",
        "index_title" => "Users List",
        "new_title" => "New User",
        "create_title" => "Add User",
        "edit_title" => "Edit User",
        "show_title" => "Show User",
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
        "name" => "Users",
        "index_title" => "Tabel Users",
        "new_title" => "Tambah User",
        "create_title" => "Tambah User",
        "edit_title" => "Edit User",
        "show_title" => "Lihat User",
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
        "created_at" => NULL,
        "updated_at" => NULL,
        "name" => "firstName()",
        "email" => "safeEmail()",
        "email_verified_at" => NULL,
        "password" => "word()",
        "remember_token" => "word()",
        "two_factor_secret" => "text(5)",
        "two_factor_recovery_codes" => "text(5)",
        "two_factor_confirmed_at" => NULL,
        "current_team_id" => "randomNumber(5, true)",
        "profile_photo_path" => NULL,
    ],
    "seeder" => 10,
    "modelName" => "User",
    "route" => "users",
    "controllerName" => "UserController",
    "viewFolder" => "users",
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
            "email",
            "current_team_id",
        ],
    ],
    "action.create" => [
        "type" => "create",
        "uploadPath" => "users/{year}/{id}",
        "rules" => [
            [
                "required",
            ],
            [
                "required",
            ],
            [
                "nullable",
            ],
            [
                "nullable",
                "string",
            ],
            [
                "nullable",
                "string",
                "email",
            ],
            [
                "nullable",
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
                "string",
            ],
            [
                "nullable",
            ],
            [
                "nullable",
                "numeric",
                "uuid",
            ],
            [
                "nullable",
                "string",
                "image",
                "extensions:jpg,png",
            ],
        ],
        "sections" => [
            "general" => [
                "title" => "User",
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
                    "created_at" => [
                        "type" => "text",
                        "config" => [
                            "required" => TRUE,
                        ],
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
                    "name" => [
                        "type" => "text",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "email" => [
                        "type" => "email",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "email_verified_at" => [
                        "type" => "text",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "password" => [
                        "type" => "text",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "remember_token" => [
                        "type" => "text",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "two_factor_secret" => [
                        "type" => "textarea",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "two_factor_recovery_codes" => [
                        "type" => "textarea",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "two_factor_confirmed_at" => [
                        "type" => "text",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "current_team_id" => [
                        "type" => "number",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "profile_photo_path" => [
                        "type" => "image",
                        "config" => [
                            "image" => "jpg,jpeg,png",
                        ],
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
        "uploadPath" => "users/{year}/{id}",
        "rules" => [
            [
                "required",
            ],
            [
                "required",
            ],
            [
                "nullable",
            ],
            [
                "nullable",
                "string",
            ],
            [
                "nullable",
                "string",
                "email",
            ],
            [
                "nullable",
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
                "string",
            ],
            [
                "nullable",
            ],
            [
                "nullable",
                "numeric",
                "uuid",
            ],
            [
                "nullable",
                "string",
                "image",
                "extensions:jpg,png",
            ],
        ],
        "sections" => [
            "general" => [
                "title" => "User",
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
                    "created_at" => [
                        "type" => "text",
                        "config" => [
                            "required" => TRUE,
                        ],
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
                    "name" => [
                        "type" => "text",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "email" => [
                        "type" => "email",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "email_verified_at" => [
                        "type" => "text",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "password" => [
                        "type" => "text",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "remember_token" => [
                        "type" => "text",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "two_factor_secret" => [
                        "type" => "textarea",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "two_factor_recovery_codes" => [
                        "type" => "textarea",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "two_factor_confirmed_at" => [
                        "type" => "text",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "current_team_id" => [
                        "type" => "number",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "profile_photo_path" => [
                        "type" => "image",
                        "config" => [
                            "image" => "jpg,jpeg,png",
                        ],
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
                "title" => "User",
                "fields" => [
                    "id" => [
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
                    "name" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "email" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "email_verified_at" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "password" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "remember_token" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "two_factor_secret" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "two_factor_recovery_codes" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "two_factor_confirmed_at" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "current_team_id" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "profile_photo_path" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                ],
            ],
        ],
    ],
];
