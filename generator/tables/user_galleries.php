<?php

return [
    "name" => "user_galleries",
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
            "name" => "file",
            "type" => "TEXT",
            "nullable" => false,
            "default" => null,
            "comment" => "#image:jpg,jpeg,png",
            "config" => [
                "image" => "jpg,jpeg,png"
            ]
        ],
        [
            "name" => "name",
            "type" => "VARCHAR",
            "nullable" => true,
            "default" => null,
            "length" => 255
        ],
        [
            "name" => "description",
            "type" => "TEXT",
            "nullable" => true,
            "default" => null
        ],
        [
            "name" => "type",
            "type" => "VARCHAR",
            "nullable" => true,
            "default" => null,
            "length" => 255
        ],
        [
            "name" => "metadata",
            "type" => "JSON",
            "nullable" => true,
            "default" => null
        ]
    ],
    "foreignKeys" => [
        [
            "name" => "fk_user_galleries_users",
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
            "name" => "fk_user_galleries_users",
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
