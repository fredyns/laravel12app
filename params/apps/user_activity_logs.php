<?php
return [
    "name" => "user_activity_logs",
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
            "name" => "title",
            "type" => "VARCHAR",
            "nullable" => FALSE,
            "default" => NULL,
            "length" => 255,
        ],
        [
            "name" => "link",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#url",
            "config" => [
                "url" => TRUE,
            ],
        ],
        [
            "name" => "message",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
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
            "name" => "fk_user_activity_logs_users_idx",
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
        "title" => "word()",
        "link" => "text(5)",
        "message" => "text(5)",
        "i_p_address" => "localIpv4()",
    ],
    "seeder" => 10,
    "modelName" => "UserActivityLogs",
    "route" => "user-activity-logs",
    "controllerName" => "UserActivityLogsController",
    "viewFolder" => "user_activity_logs",
    "index" => [
        "paginate" => 10,
        "columns" => [
            "title",
            "i_p_address",
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
        "uploadPath" => "user_activity_logs",
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
