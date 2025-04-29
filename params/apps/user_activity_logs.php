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
            "id" => "ID",
            "at" => "At",
            "user_id" => "User",
            "title" => "Title",
            "link" => "Link",
            "message" => "Message",
            "i_p_address" => "IP Address",
        ],
        "fields" => [
            "id" => "ID",
            "at" => "At",
            "user_id" => "User",
            "title" => "Title",
            "link" => "Link",
            "message" => "Message",
            "i_p_address" => "IP Address",
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
            "id" => "ID",
            "at" => "At",
            "user_id" => "User",
            "title" => "Title",
            "link" => "Link",
            "message" => "Message",
            "i_p_address" => "IP Address",
        ],
        "fields" => [
            "id" => "ID",
            "at" => "At",
            "user_id" => "User",
            "title" => "Title",
            "link" => "Link",
            "message" => "Message",
            "i_p_address" => "IP Address",
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
            "at" => ["required", "string"],
            "user_id" => ["required", "uuid", "exists:users,id"],
            "title" => ["required", "string"],
            "link" => ["nullable", "string"],
            "message" => ["nullable", "string"],
            "i_p_address" => ["nullable", "string"],
        ],
        "sections" => [
            "general" => [
                "title" => "User Activity Log",
                "fields" => [
                    "at" => [
                        "type" => "text",
                        "config" => [
                            "required" => TRUE,
                        ],
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
                        "col-lg" => "full",
                    ],
                    "title" => [
                        "type" => "text",
                        "config" => [
                            "required" => TRUE,
                        ],
                        "col-lg" => "full",
                    ],
                    "link" => [
                        "type" => "textarea",
                        "col-lg" => "full",
                    ],
                    "message" => [
                        "type" => "textarea",
                        "col-lg" => "full",
                    ],
                    "i_p_address" => [
                        "type" => "ipaddress",
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
            "at" => ["required", "string"],
            "user_id" => ["required", "uuid", "exists:users,id"],
            "title" => ["required", "string"],
            "link" => ["nullable", "string"],
            "message" => ["nullable", "string"],
            "i_p_address" => ["nullable", "string"],
        ],
        "sections" => [
            "general" => [
                "title" => "User Activity Log",
                "fields" => [
                    "at" => [
                        "type" => "text",
                        "config" => [
                            "required" => TRUE,
                        ],
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
                        "col-lg" => "full",
                    ],
                    "title" => [
                        "type" => "text",
                        "config" => [
                            "required" => TRUE,
                        ],
                        "col-lg" => "full",
                    ],
                    "link" => [
                        "type" => "textarea",
                        "col-lg" => "full",
                    ],
                    "message" => [
                        "type" => "textarea",
                        "col-lg" => "full",
                    ],
                    "i_p_address" => [
                        "type" => "ipaddress",
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
                    "at" => [
                        "col-lg" => "full",
                    ],
                    "user_id" => [
                        "col-lg" => "full",
                    ],
                    "title" => [
                        "col-lg" => "full",
                    ],
                    "link" => [
                        "col-lg" => "full",
                    ],
                    "message" => [
                        "col-lg" => "full",
                    ],
                    "i_p_address" => [
                        "col-lg" => "full",
                    ],
                ],
            ],
        ],
    ],
];