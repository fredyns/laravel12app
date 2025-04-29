<?php
return [
    "name" => "users",
    "columns" => [
        [
            "name" => "id",
            "type" => "BINARY",
            "nullable" => FALSE,
            "default" => "(UUID_TO_BIN(UUID()))",
        ],
        [
            "name" => "created_at",
            "type" => "TIMESTAMP",
            "nullable" => FALSE,
            "default" => "NOW()",
        ],
        [
            "name" => "updated_at",
            "type" => "TIMESTAMP",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        [
            "name" => "name",
            "type" => "VARCHAR",
            "nullable" => TRUE,
            "default" => NULL,
            "length" => 255,
        ],
        [
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
        [
            "name" => "email_verified_at",
            "type" => "TIMESTAMP",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        [
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
        [
            "name" => "remember_token",
            "type" => "VARCHAR",
            "nullable" => TRUE,
            "default" => NULL,
            "length" => 255,
        ],
        [
            "name" => "two_factor_secret",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        [
            "name" => "two_factor_recovery_codes",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        [
            "name" => "two_factor_confirmed_at",
            "type" => "TIMESTAMP",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        [
            "name" => "current_team_id",
            "type" => "BIGINT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#uuid",
            "config" => [
                "uuid" => TRUE,
            ],
        ],
        [
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
    "modelName" => "Users",
    "route" => "users",
    "controllerName" => "UsersController",
    "viewFolder" => "users",
    "index" => [
        "paginate" => 10,
        "columns" => [
            "name",
            "email",
            "current_team_id",
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
        "uploadPath" => "users",
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
