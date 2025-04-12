<?php

return [
    "name" => "image_resizing_queues",
    "columns" => [
        [
            "name" => "id",
            "type" => "BINARY",
            "nullable" => false,
            "default" => "(UUID_TO_BIN(UUID()))"
        ],
        [
            "name" => "created_at",
            "type" => "TIMESTAMP",
            "nullable" => false,
            "default" => "NOW()"
        ],
        [
            "name" => "source",
            "type" => "TEXT",
            "nullable" => false,
            "default" => null,
            "comment" => "#image:jpg,jpeg,png",
            "config" => [
                "image" => "jpg,jpeg,png"
            ]
        ],
        [
            "name" => "save_as",
            "type" => "TEXT",
            "nullable" => false,
            "default" => null,
            "comment" => "#image:jpg,jpeg,png",
            "config" => [
                "image" => "jpg,jpeg,png"
            ]
        ],
        [
            "name" => "width",
            "type" => "INT",
            "nullable" => true,
            "default" => null,
            "comment" => "#min:64",
            "config" => [
                "min" => 64
            ]
        ],
        [
            "name" => "height",
            "type" => "INT",
            "nullable" => true,
            "default" => null,
            "comment" => "#min:64",
            "config" => [
                "min" => 64
            ]
        ],
        [
            "name" => "remark",
            "type" => "TEXT",
            "nullable" => true,
            "default" => null
        ],
        [
            "name" => "metadata",
            "type" => "JSON",
            "nullable" => true,
            "default" => null
        ]
    ],
    "foreignKeys" => [

    ],
    "indices" => [
        [
            "name" => "created_at",
            "columns" => [
                "created_at"
            ],
            "unique" => 0
        ],
        [
            "name" => "PRIMARY",
            "columns" => [
                "id"
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
