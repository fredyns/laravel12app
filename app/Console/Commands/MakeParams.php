<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Snippet\Helpers\Arraying;
use Snippet\Helpers\NPWP;

class MakeParams extends Command
{
    const TABLE_PATH = 'params/tables';
    const APP_PATH = 'params/apps';

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
     * Execute the console command.
     */
    public function handle()
    {
        if (!is_dir(static::APP_PATH)) {
            mkdir(static::APP_PATH, 0775, true);
        }

        $tables = iterator_to_array($this->tables());
        if (empty($tables)) {
            $this->error('Table parameters not found');
            return;
        }

        foreach ($tables as $table) {
            $this->parseTable($table);
        }
    }

    protected function tables()
    {
        $path = base_path(static::TABLE_PATH);
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
         *     job: - regenerate for new creation
         */

        $path = base_path(static::APP_PATH . '/' . $tableName . '.php');
        if (file_exists($path)) {
            $param = $this->loadApp($path);
        } else {
            $param = [
                'migrationPrefix' => date('Y_m_d_His'),
            ];
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
            $table = include base_path(static::TABLE_PATH . '/' . $tableName . '.php');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
            $table = null;
        } finally {
            if (!is_array($table)) return null;

            $table['columns'] = iterator_to_array($this->addColumnKeys($table['columns']));

            if (!empty($table['foreignKeys'])) {
                $table['foreignKeys'] = iterator_to_array($this->addFkKeys($table['foreignKeys']));
            }

            return $table;
        }
    }

    protected function addColumnKeys($columns)
    {
        foreach ($columns as $column) {
            yield $column['name'] => $column;
        }
    }

    protected function addFkKeys($foreignKeys)
    {
        foreach ($foreignKeys as $foreignKey) {
            yield $foreignKey['column'] => $foreignKey;
        }
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
        $nameWithSpace = str_replace('_', ' ', $table['name']);
        $namePlural = Str::title($nameWithSpace);
        $nameSingular = Str::singular($namePlural);
        $nameStudly = Str::studly($nameSingular);
        $nameSnake = Str::snake($nameWithSpace);
        $nameSlug = Str::slug($nameWithSpace);
        $addon = [
            // lang
            'lang.en' => [
                'name' => $namePlural,
                'index_title' => $namePlural . ' List',
                'new_title' => 'New ' . $nameSingular,
                'create_title' => 'Add ' . $nameSingular,
                'edit_title' => 'Edit ' . $nameSingular,
                'show_title' => 'Show ' . $nameSingular,
                'columns' => $this->labelParams($table),
                'fields' => $this->labelParams($table),
            ],
            'lang.id' => [
                'name' => $namePlural,
                'index_title' => 'Tabel ' . $namePlural,
                'new_title' => 'Tambah ' . $nameSingular,
                'create_title' => 'Tambah ' . $nameSingular,
                'edit_title' => 'Edit ' . $nameSingular,
                'show_title' => 'Lihat ' . $nameSingular,
                'columns' => $this->labelParams($table),
                'fields' => $this->labelParams($table),
            ],
            // faker
            'faker' => iterator_to_array($this->fakerParams($table)),
            // seeder
            'seeder' => 10,
            // model
            'modelName' => $nameStudly,
            // routes
            'route' => $nameSlug,
            // controller
            'controllerName' => $nameStudly . 'Controller',
            'viewFolder' => $nameSnake,
            // policy
            'policy' => [
                'index' => 'table.index',
                'view' => 'table.show',
                'create' => 'table.create',
                'update' => 'table.update',
                'delete' => 'table.delete',
                'restore' => false,
                'forceDelete' => false,
            ],
            // actions
            'action.index' => [
                'type' => 'index',
                'paginate' => 10,
                'columns' => iterator_to_array($this->columnParams($table)), // displayed on table
                // 'extraSelect' => [], // optional
            ],
            'action.create' => [
                'type' => 'create',
                'uploadPath' => "{$table['name']}/{year}/{id}",
                'rules' => iterator_to_array($this->ruleParams($table)),
                'sections' => [
                    'general' => [
                        'title' => $nameSingular,
                        'fields' => iterator_to_array($this->inputParams($table)),
                    ],
                ],
            ],
            'action.update' => [
                'type' => 'update',
                'uploadPath' => "{$table['name']}/{year}/{id}",
                'rules' => iterator_to_array($this->ruleParams($table)),
                'sections' => [
                    'general' => [
                        'title' => $nameSingular,
                        'fields' => iterator_to_array($this->inputParams($table)),
                    ],
                ],
            ],
            'action.show' => [
                'type' => 'show',
                'sections' => [
                    'general' => [
                        'title' => $nameSingular,
                        'fields' => iterator_to_array($this->detailParams($table)),
                    ],
                ],
            ],
        ];

        return array_merge_recursive($table, $addon);
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
                if ($this->isNPWP($column['name'])) {
                    $format = str_replace('9', '#', NPWP::FORMAT);
                    return "numerify('{$format}')";
                } else if (str_contains($column['name'], 'name')) {
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
                if ($this->isNPWP($column['name'])) return 'randomNumber(15, true)';

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
                return 'randomFloat()';

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
                    return 'randomElement(' . Arraying::export($column['options'], true) . ')';
                } else {
                    return null;
                }

            default:
                return null;
        }
    }

    protected function isNPWP($columnName)
    {
        return str_contains($columnName, 'npwp') or str_contains($columnName, 'n_p_w_p');
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

    protected function ruleParams($table)
    {
        $foreignKeys = $table['foreignKeys'] ?? [];
        foreach ($table['columns'] as $column) {
            yield $column['name'] = iterator_to_array($this->ruleParam($column, $foreignKeys));
        }
    }

    protected function ruleParam($column, $foreignKeys)
    {
        $name = $column['name'] ?? '-';
        $type = $column['type'] ?? 'VARCHAR';

        if ($column['nullable'] ?? false) {
            yield 'nullable';
        } else {
            yield 'required';
        }

        $numeric = ['TINYINT', 'INT', 'BIGINT', 'DECIMAL', 'FLOAT', 'DOUBLE'];
        if (in_array($type, $numeric)) yield 'numeric';

        $string = ['VARCHAR', 'TEXT'];
        if (in_array($type, $string)) yield 'string';

        if ($type === 'DATETIME') yield 'date';
        if ($type === 'TIME') yield 'date_format:H:i';
        if ($type === 'ENUM' && isset($column['options'])) yield 'in:' . implode(',', $column['options']);

        if ($column['config']['uuid'] ?? false) yield 'uuid';
        if ($column['config']['email'] ?? false) yield 'email';
        if ($column['config']['ipaddress'] ?? false) yield 'ip';

        if ($column['config']['url'] ?? false) {
            yield 'url:http,https';
        }
        if ($column['config']['file'] ?? false) {
            yield 'file';
            yield 'extensions:pdf,docx,xlsx,pptx,jpg,png,zip,rar';
        }
        if ($column['config']['image'] ?? false) {
            yield 'image';
            yield 'extensions:jpg,png';
        }

        $rule1 = [
            'min', 'max', 'decimal',
            'lt', 'lte', 'gt', 'gte',
            'same', 'size', 'min_digits', 'regex',
            'after', 'before', 'after_or_equal', 'before_or_equal', 'date_equals', 'date_format',
            'dimensions',
        ];
        foreach ($rule1 as $rule) {
            if (isset($column['config'][$rule])) yield $rule . ':' . $column['config'][$rule];
        }

        // relationship
        if (isset($foreignKeys[$name]['referenced_table']) && isset($foreignKeys[$name]['referenced_column'])) {
            yield 'exists:' . $foreignKeys[$name]['referenced_table'] . "," . $foreignKeys[$name]['referenced_column'];
        }
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
        if (isset(static::$titleCols[$tableName])) return static::$titleCols[$tableName];

        $appropriateColumns = ['title', 'name', 'label', 'number', 'email'];

        try {
            $table = include base_path(static::TABLE_PATH . '/' . $tableName . '.php');

            // search exact name
            foreach ($table['columns'] as $column) {
                if (in_array($column['name'], $appropriateColumns)) {
                    return static::$titleCols[$tableName] = $column['name'];
                }
            }

            // search pattern
            foreach ($table['columns'] as $column) {
                foreach ($appropriateColumns as $columnName) {
                    if (str_contains($column['name'], $columnName)) return static::$titleCols[$tableName] = $column['name'];
                }
            }

            // fallback
            if (isset($table['columns'][0]['name'])) return static::$titleCols[$tableName] = $table['columns'][0]['name'];

        } catch (\Exception $exception) {
            return static::$titleCols[$tableName] = null;
        }

        return static::$titleCols[$tableName] = null;
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

    protected function detailParams($table)
    {
        foreach ($table['columns'] as $column) {
            yield $column['name'] => $this->detailParam($column);
        }
    }

    protected function detailParam($column): array
    {
        return [
            'col' => 'full',
            'col-md' => 'full',
            'col-lg' => 'full',
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
        Arraying::saveToFile($param, static::APP_PATH . '/' . $tableName . '.php');
    }
}
