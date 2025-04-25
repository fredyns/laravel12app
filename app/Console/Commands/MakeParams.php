<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Snippet\Helpers\Arraying;

class MakeParams extends Command
{
    const TABLE_PATH = 'generator/tables';
    const APP_PATH = 'generator/apps';
    const MIGRATION_ORDER_PATH = 'generator/migration-order.php';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:params';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create parameters for app generator';

    /**
     * mark prefix for each table migration
     * format: [
     *              table-name => prefix
     *          ]
     *
     * @var array
     */
    protected $migrationOrder = [];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!is_dir(self::APP_PATH)) {
            mkdir(self::APP_PATH, 0775, true);
        }

        $this->loadMigrationOrder();

        $tables = $this->tables();
        if (empty($tables)) {
            $this->error('Table parameters not found');
            return;
        }

        foreach ($tables as $table) {
            $this->parseTable($table);
        }

        $this->saveMigrationOrder();
    }

    protected function loadMigrationOrder()
    {
        $path = base_path(self::MIGRATION_ORDER_PATH);
        if (!file_exists($path)) {
            return;
        }

        $order = include $path;
        if (!empty($order) && is_array($order)) {
            $this->migrationOrder = $order;
        }
    }

    protected function tables()
    {
        $path = base_path(SELF::TABLE_PATH);
        $files = scandir($path);

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                yield pathinfo($file, PATHINFO_FILENAME);
            }
        }
    }

    protected function parseTable($tableName)
    {
        $table = $this->loadTable($tableName);
        if (empty($table)) return;

        /**
         * 3 possible scenarios regarding app params:
         *  1. exist & valid
         *     job: - regenerate for update
         *  2. exist but invalid
         *     job: - regenerate for update
         *  3. new, not exist yet
         *     job: - put to migration order
         *          - regenerate for new creation
         */

        $path = base_path(self::APP_PATH . '/' . $tableName . '.php');
        if (file_exists($path)) {
            $param = $this->loadApp($path);
        } else {
            $this->addMigrationOrder($tableName);
            $param = [];
        }

        $param = array_merge_recursive($param, $this->generateParam($table));

        $this->saveParam($param, $tableName);
    }

    /**
     * load table parameters/metadata
     *
     * @param $tableName
     * @return mixed
     */

    protected function loadTable($tableName)
    {
        try {
            $table = include base_path(self::TABLE_PATH . '/' . $tableName . '.php');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
            $table = null;
        } finally {
            if (!is_array($table)) return null;

            if (!empty($table['foreignKeys'])) {
                $table['foreignKeys'] = iterator_to_array($this->addFkKeys($table['foreignKeys']));
            }

            return $table;
        }
    }

    protected function addFkKeys($foreignKeys)
    {
        foreach ($foreignKeys as $foreignKey) {
            yield $foreignKey['column'] => $foreignKey;
        }
    }

    protected function addMigrationOrder($tableName)
    {
        $this->migrationOrder[$tableName] = date('Y_m_d_His');
    }

    /**
     * load app parameters, if any
     * @param $tableName
     * @return mixed
     */

    protected function loadApp($path)
    {
        try {
            $app = include $path;

            if (is_array($app)) return $app; // sweet flow

            $this->error('App parameters should be an array');
            return [];

        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
            return [];
        }
    }

    protected function generateParam($table)
    {
        $studlyName = Str::studly($table['name']);
        $addon = [
            // migration directly parsing columns params
            // faker
            'faker' => iterator_to_array($this->fakerParams($table)),
            // seeder
            'seeder' => 10,
            // model
            'modelName' => $studlyName,
            // routes
            'route' => Str::slug($table['name']),
            // controller
            'controllerName' => $studlyName . 'Controller',
            'viewFolder' => Str::snake($table['name']),
            // index action
            'index' => [
                'paginate' => 10,
                'columns' => iterator_to_array($this->columnParams($table)), // displayed on table
                // 'extraSelect' => [], // optional
            ],
            // create & update action
            'form' => [
                'fields' => iterator_to_array($this->inputParams($table)),
                'uploadPath' => $table['name'],
                'rules' => [
                    // todo: sampe siniiiiiiiiiiiii
                    //todo: rules
                ],
            ],
            // show action
            'show' => [
                'cards' => [
                    'general' => [
                        'title' => 'Model',
                        'fields' => ($this->detailsParams($table)),
                    ],
                ],
            ],
            // policy
            'policy' => [
                'viewAny' => 'table.index',
                'view' => 'table.show',
                'create' => 'table.create',
                'update' => 'table.update',
                'delete' => 'table.delete',
                'deleteAny' => 'table.delete',
                'restore' => false,
                'forceDelete' => false,
            ],
            // lang
            'lang' => [
                'name' => 'Records',
                'index_title' => 'Records List',
                'new_title' => 'New Record',
                'create_title' => 'Create Record',
                'edit_title' => 'Edit Record',
                'show_title' => 'Show Record',
                'columns' => $this->labelParams($table),
                'fields' => $this->labelParams($table),
            ],
        ];

        return array_merge($table, $addon);
    }

    /**
     * @param $table
     * @return array|\Generator
     */

    protected function fakerParams($table)
    {
        if (!isset($table['columns']) or !is_array($table['columns'])) {
            return [];
        }

        foreach ($table['columns'] as $column) {
            if (!isset($column['name'])) continue;

            yield $column['name'] => $this->fakerParam($column);
        }
    }

    protected function fakerParam($column)
    {
        $type = $column['type'] ?? 'VARCHAR';

        // todo: faker regarding relationship

        switch ($type) {
            case 'BINARY':
                $isUuid = $column['config']['uuid'] ?? false;
                $noDefault = (!isset($column['default']) or empty($column['default']));
                $isRelation = str_ends_with($column['name'], "_by");

                if ($isUuid && $noDefault && !$isRelation) {
                    return 'uuid()';
                }

                return null;

            case 'VARCHAR':
                if (str_contains($column['name'], 'name')) {
                    return 'firstName()';
                } else if (str_contains($column['name'], 'number')) {
                    return 'phoneNumber()';
                } else if ($column['config']['email'] ?? false) {
                    return 'safeEmail()';
                } else if ($column['config']['ipaddress'] ?? false) {
                    return 'localIpv4()';
                } else {
                    return 'word()';
                }
            case 'INT':
            case 'BIGINT':
                return 'randomNumber(5, true)';

            case 'TINYINT':
                if ($column['config']['boolean'] ?? false) {
                    return 'boolean(0.5)';
                } else {
                    return 'numberBetween(0, 255)';
                }

            case 'DECIMAL':
            case 'FLOAT':
            case 'DOUBLE':
                return 'randomFloat(5, true)';

            case 'DATETIME':
            case 'DATE':
                return 'dateTimeThisDecade()';

            case 'TIME':
                return 'time()';

            case 'YEAR':
                return 'year()';

            case 'TEXT':
                if ($column['config']['wysiwyg'] ?? false) {
                    return 'randomHtml()';
                } else if ($column['config']['markdown'] ?? false) {
                    return 'paragraph()';
                } else if ($column['config']['file'] ?? false) {
                    return null;
                } else if ($column['config']['image'] ?? false) {
                    return null;
                } else {
                    return 'text(5)';
                }

            case 'ENUM':
                if (isset($column['options']) and is_array($column['options'])) {
                    return 'randomElement(' . var_export($column['options'], true) . ')';
                } else {
                    return null;
                }

            default:
                return null;
        }
    }

    protected function columnParams($table)
    {
        $exceptionsByName = [
            'id', 'created_at', 'updated_at', 'created_by', 'updated_by',
            'email_verified_at', 'password', 'remember_token',
            'metadata',
        ];
        $exceptionsByType = [
            'BINARY',
            'TEXT',
            'TIMESTAMP',
        ];
        foreach ($table['columns'] as $column) {
            if (in_array($column['name'], $exceptionsByName)) continue;
            if (in_array($column['type'], $exceptionsByType)) continue;

            yield $column['name'];
        }
    }

    protected function inputParams($table)
    {
        foreach ($table['columns'] as $column) {
            if (isset($table['foreignKeys'][$column['name']])) {
                $param = $this->selectParam($column, $table['foreignKeys'][$column['name']]);
            } else {
                $param = $this->inputParam($column);
            }

            $nullable = $column['nullable'] ?? false;
            if (!$nullable) {
                $param['config']['required'] = true;
            }

            // common input params
            $param += [
                'col' => 'full',
                'col-md' => 'full', // optional
                'col-lg' => 'full', // optional
            ];

            yield $column['name'] => $param;
        }

//        return [
//            'field-name' => [
//                'type' => 'string',
//                'label' => 'Field',
//                'placeholder' => 'Field',
//                'description' => 'Field', // optional
//                'col' => 'full',
//                'col-md' => 'full', // optional
//                'col-lg' => 'full', // optional
//            ],
//        ];
    }

    protected function selectParam($column, $foreignKey)
    {
        return [
            'type' => 'select',
            'config' => [
                'model' => 'App\\Models\\' . Str::studly($foreignKey['referenced_table']),
                'key' => $foreignKey['referenced_column'],
                'label' => $this->tableTitleColumn($foreignKey['referenced_table']),
            ],
        ];
    }

    protected static $titleCols = [];

    protected function tableTitleColumn($tableName)
    {
        if (isset(self::$titleCols[$tableName])) return self::$titleCols[$tableName];

        $appropriateColumns = ['title', 'name', 'label', 'number', 'email'];

        try {
            $table = include base_path(self::TABLE_PATH . '/' . $tableName . '.php');

            // search exact name
            foreach ($table['columns'] as $column) {
                if (in_array($column['name'], $appropriateColumns)) {
                    return self::$titleCols[$tableName] = $column['name'];
                }
            }

            // search pattern
            foreach ($table['columns'] as $column) {
                foreach ($appropriateColumns as $columnName) {
                    if (str_contains($column['name'], $columnName)) return self::$titleCols[$tableName] = $column['name'];
                }
            }

            // fallback
            if (isset($table['columns'][0]['name'])) return self::$titleCols[$tableName] = $table['columns'][0]['name'];

        } catch (\Exception $exception) {
            return self::$titleCols[$tableName] = null;
        }

        return self::$titleCols[$tableName] = null;
    }

    protected function inputParam($column)
    {
        switch ($column['type']) {
            case 'INT':
            case 'BIGINT':
            case 'TINYINT':
            case 'DECIMAL':
            case 'FLOAT':
            case 'DOUBLE':
                $param = ['type' => 'number'];

                $this->copyConfigs(['min', 'max', 'step'], $column, $param);

                if ($column['config']['slider'] ?? false) $param['type'] = 'slider';
                if ($column['config']['boolean'] ?? false) $param['type'] = 'checkbox';

                $npwpPattern1 = str_contains($column['name'], 'npwp');
                $npwpPattern2 = str_contains($column['name'], 'n_p_w_p');
                if ($npwpPattern1 or $npwpPattern2) $param['type'] = 'npwp';

                return $param;

            case 'DATETIME':
                return ['type' => 'datetime'];

            case 'DATE':
                return ['type' => 'date'];

            case 'TIME':
                return ['type' => 'time'];

            case 'YEAR':
                return ['type' => 'year'];

            case 'TEXT':
                $param = ['type' => 'textarea'];

                if ($column['config']['wysiwyg'] ?? false) $param['type'] = 'wysiwyg';
                if ($column['config']['markdown'] ?? false) $param['type'] = 'markdown';
                if ($column['config']['file'] ?? false) $param['type'] = 'file';
                if ($column['config']['image'] ?? false) $param['type'] = 'image';

                $this->copyConfigs(['cols', 'rows', 'image'], $column, $param);

                return $param;

            case 'ENUM':
                $param = [
                    'type' => 'select',
                    'options' => [],
                ];

                if (isset($column['options']) and is_array($column['options'])) {
                    $param['options'] = array_combine($column['options'], $column['options']);
                }

                return $param;

            case 'VARCHAR':

            default:
                $param = ['type' => 'text'];

                if ($column['config']['email'] ?? false) $param['type'] = 'email';
                if ($column['config']['ipaddress'] ?? false) $param['type'] = 'ipaddress';

                $this->copyConfigs(['min', 'max'], $column, $param);

                return $param;
        }

    }

    protected function copyConfigs($keys, $from, &$to)
    {
        foreach ($keys as $key) {
            if (isset($from['config'][$key])) {
                $to['config'][$key] = $from['config'][$key];
            }
        }
    }

    protected function detailsParams($table)
    {
        return [
            // todo: generate input to show
            'field-name' => [
                'col' => 'full',
                'col-md' => 'full', // optional
                'col-lg' => 'full', // optional
            ],
        ];
    }


    protected function labelParams($table)
    {
        return [
            'user_id' => 'User',
            'string' => 'String',
        ];
    }

    protected function saveParam($param, $tableName)
    {
        $filePath = base_path(self::APP_PATH . '/' . $tableName . '.php');
        $content = '<?php return ' . var_export($param, true) . ';';

        file_put_contents($filePath, $content);
    }

    protected function saveMigrationOrder()
    {
        $filePath = base_path(self::MIGRATION_ORDER_PATH);
        $content = '<?php return ' . var_export($this->migrationOrder, true) . ';';

        file_put_contents($filePath, $content);
    }

}
