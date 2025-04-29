<?php
return [
    "name" => "image_resizing_queues",
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
            "name" => "source",
            "type" => "TEXT",
            "nullable" => FALSE,
            "default" => NULL,
            "comment" => "#image:jpg,jpeg,png",
            "config" => [
                "image" => "jpg,jpeg,png",
            ],
        ],
        [
            "name" => "save_as",
            "type" => "TEXT",
            "nullable" => FALSE,
            "default" => NULL,
            "comment" => "#image:jpg,jpeg,png",
            "config" => [
                "image" => "jpg,jpeg,png",
            ],
        ],
        [
            "name" => "width",
            "type" => "INT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#min:64",
            "config" => [
                "min" => 64,
            ],
        ],
        [
            "name" => "height",
            "type" => "INT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#min:64",
            "config" => [
                "min" => 64,
            ],
        ],
        [
            "name" => "remark",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        [
            "name" => "metadata",
            "type" => "JSON",
            "nullable" => TRUE,
            "default" => NULL,
        ],
    ],
    "foreignKeys" => [],
    "indices" => [
        [
            "name" => "created_at",
            "columns" => [
                "created_at",
            ],
            "unique" => 0,
        ],
        [
            "name" => "PRIMARY",
            "columns" => [
                "id",
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
        "source" => NULL,
        "save_as" => NULL,
        "width" => "randomNumber(5, true)",
        "height" => "randomNumber(5, true)",
        "remark" => "text(5)",
        "metadata" => NULL,
    ],
    "seeder" => 10,
    "modelName" => "ImageResizingQueues",
    "route" => "image-resizing-queues",
    "controllerName" => "ImageResizingQueuesController",
    "viewFolder" => "image_resizing_queues",
    "index" => [
        "paginate" => 10,
        "columns" => [
            "width",
            "height",
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
            "source" => [
                "type" => "image",
                "config" => [
                    "image" => "jpg,jpeg,png",
                    "required" => TRUE,
                ],
                "col" => "full",
                "col-md" => "full",
                "col-lg" => "full",
            ],
            "save_as" => [
                "type" => "image",
                "config" => [
                    "image" => "jpg,jpeg,png",
                    "required" => TRUE,
                ],
                "col" => "full",
                "col-md" => "full",
                "col-lg" => "full",
            ],
            "width" => [
                "type" => "number",
                "config" => [
                    "min" => 64,
                ],
                "col" => "full",
                "col-md" => "full",
                "col-lg" => "full",
            ],
            "height" => [
                "type" => "number",
                "config" => [
                    "min" => 64,
                ],
                "col" => "full",
                "col-md" => "full",
                "col-lg" => "full",
            ],
            "remark" => [
                "type" => "textarea",
                "col" => "full",
                "col-md" => "full",
                "col-lg" => "full",
            ],
            "metadata" => [
                "type" => "text",
                "col" => "full",
                "col-md" => "full",
                "col-lg" => "full",
            ],
        ],
        "uploadPath" => "image_resizing_queues",
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
