<?php
return [
    "migrationPrefix" => "2025_04_29_075641",
    "name" => "image_resizing_queues",
    "columns" => [
        "id" => [
            "name" => "id",
            "type" => "BINARY",
            "nullable" => FALSE,
            "default" => "(UUID_TO_BIN(UUID()))",
        ],
        "created_at" => [
            "name" => "created_at",
            "type" => "TIMESTAMP",
            "nullable" => FALSE,
            "default" => "NOW()",
        ],
        "source" => [
            "name" => "source",
            "type" => "TEXT",
            "nullable" => FALSE,
            "default" => NULL,
            "comment" => "#image:jpg,jpeg,png",
            "config" => [
                "image" => "jpg,jpeg,png",
            ],
        ],
        "save_as" => [
            "name" => "save_as",
            "type" => "TEXT",
            "nullable" => FALSE,
            "default" => NULL,
            "comment" => "#image:jpg,jpeg,png",
            "config" => [
                "image" => "jpg,jpeg,png",
            ],
        ],
        "width" => [
            "name" => "width",
            "type" => "INT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#min:64",
            "config" => [
                "min" => 64,
            ],
        ],
        "height" => [
            "name" => "height",
            "type" => "INT",
            "nullable" => TRUE,
            "default" => NULL,
            "comment" => "#min:64",
            "config" => [
                "min" => 64,
            ],
        ],
        "remark" => [
            "name" => "remark",
            "type" => "TEXT",
            "nullable" => TRUE,
            "default" => NULL,
        ],
        "metadata" => [
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
            "columns" => ["created_at"],
            "unique" => 0,
        ],
        [
            "name" => "PRIMARY",
            "columns" => ["id"],
            "unique" => 0,
        ],
    ],
    "primaryKey" => [
        "name" => "PRIMARY",
        "columns" => ["id"],
    ],
    "lang.en" => [
        "name" => "Image Resizing Queues",
        "index_title" => "Image Resizing Queues List",
        "new_title" => "New Image Resizing Queue",
        "create_title" => "Add Image Resizing Queue",
        "edit_title" => "Edit Image Resizing Queue",
        "show_title" => "Show Image Resizing Queue",
        "columns" => [
            "id" => "ID",
            "created_at" => "Created At",
            "source" => "Source",
            "save_as" => "Save As",
            "width" => "Width",
            "height" => "Height",
            "remark" => "Remark",
            "metadata" => "Metadata",
        ],
        "fields" => [
            "id" => "ID",
            "created_at" => "Created At",
            "source" => "Source",
            "save_as" => "Save As",
            "width" => "Width",
            "height" => "Height",
            "remark" => "Remark",
            "metadata" => "Metadata",
        ],
    ],
    "lang.id" => [
        "name" => "Image Resizing Queues",
        "index_title" => "Tabel Image Resizing Queues",
        "new_title" => "Tambah Image Resizing Queue",
        "create_title" => "Tambah Image Resizing Queue",
        "edit_title" => "Edit Image Resizing Queue",
        "show_title" => "Lihat Image Resizing Queue",
        "columns" => [
            "id" => "ID",
            "created_at" => "Created At",
            "source" => "Source",
            "save_as" => "Save As",
            "width" => "Width",
            "height" => "Height",
            "remark" => "Remark",
            "metadata" => "Metadata",
        ],
        "fields" => [
            "id" => "ID",
            "created_at" => "Created At",
            "source" => "Source",
            "save_as" => "Save As",
            "width" => "Width",
            "height" => "Height",
            "remark" => "Remark",
            "metadata" => "Metadata",
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
    "modelName" => "ImageResizingQueue",
    "route" => "image-resizing-queues",
    "controllerName" => "ImageResizingQueueController",
    "viewFolder" => "image_resizing_queues",
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
        "columns" => ["width", "height"],
    ],
    "action.create" => [
        "type" => "create",
        "uploadPath" => "image_resizing_queues/{year}/{id}",
        "rules" => [
            "source" => ["required", "string"],
            "save_as" => ["required", "string"],
            "width" => ["nullable", "numeric", "min:64"],
            "height" => ["nullable", "numeric", "min:64"],
            "remark" => ["nullable", "string"],
        ],
        "sections" => [
            "general" => [
                "title" => "Image Resizing Queue",
                "fields" => [
                    "source" => [
                        "type" => "image",
                        "config" => [
                            "image" => "jpg,jpeg,png",
                            "required" => TRUE,
                        ],
                        "col-lg" => "full",
                    ],
                    "save_as" => [
                        "type" => "image",
                        "config" => [
                            "image" => "jpg,jpeg,png",
                            "required" => TRUE,
                        ],
                        "col-lg" => "full",
                    ],
                    "width" => [
                        "type" => "number",
                        "config" => [
                            "min" => 64,
                        ],
                        "col-lg" => "full",
                    ],
                    "height" => [
                        "type" => "number",
                        "config" => [
                            "min" => 64,
                        ],
                        "col-lg" => "full",
                    ],
                    "remark" => [
                        "type" => "textarea",
                        "col-lg" => "full",
                    ],
                ],
            ],
        ],
    ],
    "action.update" => [
        "type" => "update",
        "uploadPath" => "image_resizing_queues/{year}/{id}",
        "rules" => [
            "source" => ["required", "string"],
            "save_as" => ["required", "string"],
            "width" => ["nullable", "numeric", "min:64"],
            "height" => ["nullable", "numeric", "min:64"],
            "remark" => ["nullable", "string"],
        ],
        "sections" => [
            "general" => [
                "title" => "Image Resizing Queue",
                "fields" => [
                    "source" => [
                        "type" => "image",
                        "config" => [
                            "image" => "jpg,jpeg,png",
                            "required" => TRUE,
                        ],
                        "col-lg" => "full",
                    ],
                    "save_as" => [
                        "type" => "image",
                        "config" => [
                            "image" => "jpg,jpeg,png",
                            "required" => TRUE,
                        ],
                        "col-lg" => "full",
                    ],
                    "width" => [
                        "type" => "number",
                        "config" => [
                            "min" => 64,
                        ],
                        "col-lg" => "full",
                    ],
                    "height" => [
                        "type" => "number",
                        "config" => [
                            "min" => 64,
                        ],
                        "col-lg" => "full",
                    ],
                    "remark" => [
                        "type" => "textarea",
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
                "title" => "Image Resizing Queue",
                "fields" => [
                    "source" => [
                        "col-lg" => "full",
                    ],
                    "save_as" => [
                        "col-lg" => "full",
                    ],
                    "width" => [
                        "col-lg" => "full",
                    ],
                    "height" => [
                        "col-lg" => "full",
                    ],
                    "remark" => [
                        "col-lg" => "full",
                    ],
                ],
            ],
        ],
    ],
];