<?php
return [
    "migrationPrefix" => "2025_04_29_075641",
    "name" => "user_activity_logs",
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
        "title" => [
            "name" => "title",
            "type" => "VARCHAR",
            "nullable" => FALSE,
            "default" => NULL,
            "length" => 255,
        ],
        "link" => [
            "name" => "link",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#url",
            "config" => [
                "url" => TRUE,
            ],
        ],
        "message" => [
            "name" => "message",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
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
    ],
    "foreignKeys" => [
        "user_id" => [
            "name" => "fk_user_activity_logs_users",
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
            "name" => "fk_user_activity_logs_users_idx",
            "columns" => ["user_id"],
            "unique" => 0,
        ],
    ],
    "primaryKey" => [
        "name" => "PRIMARY",
        "columns" => ["id"],
    ],
    "lang.en" => [
        "name" => "User Activity Logs",
        "index_title" => "User Activity Logs List",
        "new_title" => "New User Activity Log",
        "create_title" => "Add User Activity Log",
        "edit_title" => "Edit User Activity Log",
        "show_title" => "Show User Activity Log",
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
        "name" => "User Activity Logs",
        "index_title" => "Tabel User Activity Logs",
        "new_title" => "Tambah User Activity Log",
        "create_title" => "Tambah User Activity Log",
        "edit_title" => "Edit User Activity Log",
        "show_title" => "Lihat User Activity Log",
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
        "title" => "word()",
        "link" => "text(5)",
        "message" => "text(5)",
        "i_p_address" => "localIpv4()",
    ],
    "seeder" => 10,
    "modelName" => "UserActivityLog",
    "route" => "user-activity-logs",
    "controllerName" => "UserActivityLogController",
    "viewFolder" => "user_activity_logs",
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
        "columns" => ["title", "i_p_address"],
    ],
    "action.create" => [
        "type" => "create",
        "uploadPath" => "user_activity_logs/{year}/{id}",
        "rules" => [
            ["required"],
            ["required"],
            ["required", "uuid", "exists:users,id"],
            ["required", "string"],
            ["nullable", "string", "url:http,https"],
            ["nullable", "string"],
            ["nullable", "string", "ip"],
        ],
        "sections" => [
            "general" => [
                "title" => "User Activity Log",
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
                    "title" => [
                        "type" => "text",
                        "config" => [
                            "required" => TRUE,
                        ],
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "link" => [
                        "type" => "textarea",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "message" => [
                        "type" => "textarea",
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
                ],
            ],
        ],
    ],
    "action.update" => [
        "type" => "update",
        "uploadPath" => "user_activity_logs/{year}/{id}",
        "rules" => [
            ["required"],
            ["required"],
            ["required", "uuid", "exists:users,id"],
            ["required", "string"],
            ["nullable", "string", "url:http,https"],
            ["nullable", "string"],
            ["nullable", "string", "ip"],
        ],
        "sections" => [
            "general" => [
                "title" => "User Activity Log",
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
                    "title" => [
                        "type" => "text",
                        "config" => [
                            "required" => TRUE,
                        ],
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "link" => [
                        "type" => "textarea",
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "message" => [
                        "type" => "textarea",
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
                ],
            ],
        ],
    ],
    "action.show" => [
        "type" => "show",
        "sections" => [
            "general" => [
                "title" => "User Activity Log",
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
                    "title" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "link" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "message" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                    "i_p_address" => [
                        "col" => "full",
                        "col-md" => "full",
                        "col-lg" => "full",
                    ],
                ],
            ],
        ],
    ],
];
