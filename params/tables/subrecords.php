<?php

return [
    "name" => "subrecords",
    "columns" => [
        [
            "name" => "id",
            "type" => "BINARY",
            "nullable" => false,
            "default" => "(UUID_TO_BIN(UUID()))"
        ],
        [
            "name" => "records_id",
            "type" => "BINARY",
            "nullable" => false,
            "default" => null,
            "comment" => "#uuid",
            "config" => [
                "uuid" => true
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
        ]
    ],
    "foreignKeys" => [
        [
            "name" => "fk_subrecords_records",
            "column" => "records_id",
            "referenced_table" => "records",
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
            "name" => "fk_subrecords_records",
            "columns" => [
                "records_id"
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
