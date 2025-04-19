<?php

return [
    "name" => "records",
    "columns" => [
        [
            "name" => "id",
            "type" => "BINARY",
            "nullable" => false,
            "default" => "(UUID_TO_BIN(UUID()))"
        ],
        [
            "name" => "user_id",
            "type" => "BINARY",
            "nullable" => true,
            "default" => null,
            "comment" => "#uuid",
            "config" => [
                "uuid" => true
            ]
        ],
        [
            "name" => "string",
            "type" => "VARCHAR",
            "nullable" => false,
            "default" => null,
            "length" => 255
        ],
        [
            "name" => "email",
            "type" => "VARCHAR",
            "nullable" => true,
            "default" => null,
            "length" => 255,
            "comment" => "#email",
            "config" => [
                "email" => true
            ]
        ],
        [
            "name" => "integer",
            "type" => "INT",
            "nullable" => true,
            "default" => null,
            "comment" => "#slider #min:1 #max:100",
            "config" => [
                "slider" => true,
                "min" => 1,
                "max" => 100
            ]
        ],
        [
            "name" => "decimal",
            "type" => "DECIMAL",
            "nullable" => true,
            "default" => null
        ],
        [
            "name" => "n_p_w_p",
            "type" => "BIGINT",
            "nullable" => true,
            "default" => null,
            "comment" => "#npwp",
            "config" => [
                "npwp" => true
            ]
        ],
        [
            "name" => "datetime",
            "type" => "DATETIME",
            "nullable" => true,
            "default" => null
        ],
        [
            "name" => "date",
            "type" => "DATE",
            "nullable" => true,
            "default" => null
        ],
        [
            "name" => "time",
            "type" => "TIME",
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
        ],
        [
            "name" => "boolean",
            "type" => "TINYINT",
            "nullable" => true,
            "default" => null,
            "comment" => "#boolean",
            "config" => [
                "boolean" => true
            ]
        ],
        [
            "name" => "enumerate",
            "type" => "ENUM",
            "nullable" => true,
            "default" => null,
            "options" => [
                "enable",
                "disable"
            ]
        ],
        [
            "name" => "text",
            "type" => "TEXT",
            "nullable" => true,
            "default" => null
        ],
        [
            "name" => "file",
            "type" => "TEXT",
            "nullable" => true,
            "default" => null,
            "comment" => "#file",
            "config" => [
                "file" => true
            ]
        ],
        [
            "name" => "image",
            "type" => "TEXT",
            "nullable" => true,
            "default" => null,
            "comment" => "#image:jpg,jpeg,png",
            "config" => [
                "image" => "jpg,jpeg,png"
            ]
        ],
        [
            "name" => "markdown_text",
            "type" => "TEXT",
            "nullable" => true,
            "default" => null,
            "comment" => "#markdown",
            "config" => [
                "markdown" => true
            ]
        ],
        [
            "name" => "w_y_s_i_w_y_g",
            "type" => "TEXT",
            "nullable" => true,
            "default" => null,
            "comment" => "#wysiwyg",
            "config" => [
                "wysiwyg" => true
            ]
        ],
        [
            "name" => "latitude",
            "type" => "DECIMAL",
            "nullable" => true,
            "default" => null
        ],
        [
            "name" => "longitude",
            "type" => "DECIMAL",
            "nullable" => true,
            "default" => null
        ],
        [
            "name" => "created_at",
            "type" => "TIMESTAMP",
            "nullable" => true,
            "default" => "NOW()"
        ],
        [
            "name" => "updated_at",
            "type" => "TIMESTAMP",
            "nullable" => true,
            "default" => null
        ],
        [
            "name" => "created_by",
            "type" => "BINARY",
            "nullable" => true,
            "default" => null
        ],
        [
            "name" => "updated_by",
            "type" => "BINARY",
            "nullable" => true,
            "default" => null
        ]
    ],
    "foreignKeys" => [
        [
            "name" => "fk_records_users",
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
            "name" => "created_at",
            "columns" => [
                "created_at"
            ],
            "unique" => 0
        ],
        [
            "name" => "fk_records_users",
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
