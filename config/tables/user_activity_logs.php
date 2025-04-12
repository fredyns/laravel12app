<?php

return [
    "name" => "user_activity_logs",
    "columns" => [
        [
            "name" => "id",
            "type" => "BINARY",
            "nullable" => false,
            "default" => "(UUID_TO_BIN(UUID()))"
        ],
        [
            "name" => "at",
            "type" => "TIMESTAMP",
            "nullable" => false,
            "default" => null
        ],
        [
            "name" => "user_id",
            "type" => "BINARY",
            "nullable" => false,
            "default" => null,
            "comment" => "#uuid",
            "config" => [
                "uuid" => true
            ]
        ],
        [
            "name" => "title",
            "type" => "VARCHAR",
            "nullable" => false,
            "default" => null,
            "length" => 255
        ],
        [
            "name" => "link",
            "type" => "TEXT",
            "nullable" => true,
            "default" => null,
            "comment" => "#url",
            "config" => [
                "url" => true
            ]
        ],
        [
            "name" => "message",
            "type" => "TEXT",
            "nullable" => true,
            "default" => null
        ],
        [
            "name" => "i_p_address",
            "type" => "VARCHAR",
            "nullable" => true,
            "default" => null,
            "length" => 255,
            "comment" => "#ipaddress",
            "config" => [
                "ipaddress" => true
            ]
        ]
    ],
    "foreignKeys" => [
        [
            "name" => "fk_user_activity_logs_users",
            "column" => "user_id",
            "referenced_table" => "users",
            "referenced_column" => "id"
        ]
    ],
    "indices" => [
        [
            "name" => "PRIMARY",
            "columns" => [
                "id"
            ],
            "unique" => 0
        ],
        [
            "name" => "at",
            "columns" => [
                "at"
            ],
            "unique" => 0
        ],
        [
            "name" => "fk_user_activity_logs_users_idx",
            "columns" => [
                "user_id"
            ],
            "unique" => 0
        ]
    ],
    "primaryKey" => [
        "name" => "PRIMARY",
        "columns" => [
            "id"
        ]
    ]
];
