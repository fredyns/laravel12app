<?php

namespace Snippet\Helpers;

use Generator;

class Arraying
{
    protected const TAB_SIZE = 4;

    protected static bool $inline = false;

    public static function saveToFile(Generator|array $array, string $filePath)
    {
        file_put_contents(base_path($filePath), Arraying::exportAsFile($array));
    }

    public static function exportAsFile(Generator|array $array, bool $inline = false): string
    {
        return "<?php\nreturn " . self::export($array, $inline) . ";";
    }

    public static function export(Generator|array $array, bool $inline = false): string
    {
        self::$inline = $inline;
        $indent = $inline ? -1 : 0;

        return self::exporting($array, $indent);
    }

    protected static function exporting($array, $indent): string
    {
        if ($array instanceof Generator) {
            $array = iterator_to_array($array);
        }

        if (!is_array($array) or empty($array)) {
            return '[]';
        }

        return (array_is_list($array)) ?
            self::exportList($array, $indent) :
            self::exportKeyPair($array, $indent);
    }

    protected static function exportList(array $array, $indent = 0): string
    {
        $nextIndent = $indent + 1;

        if (static::areNumbers($array)) {
            return '[' . implode(', ', $array) . ']';
        }

        $lines = [];
        $charLength = 0;
        $allScalar = true;
        foreach ($array as $value) {
            $line = self::exportValue($value, $nextIndent);
            $lines[] = $line;
            $allScalar = $allScalar && is_scalar($value);

            if (is_scalar($value)) $charLength += strlen($line) + 2; // plus comma & space
        }

        $charLimit = 80 - ($indent * self::TAB_SIZE);
        if ($allScalar && $charLength <= $charLimit) {
            return '[' . implode(', ', $lines) . ']';
        }

        return "[\n"
            . self::tabs($indent + 1) . implode(",\n" . self::tabs($indent + 1), $lines) . ",\n"
            . self::tabs($indent) . ']';
    }

    protected static function areNumbers(array $array): bool
    {
        $numbers = array_filter($array, 'is_numeric');
        return count($numbers) == count($array);
    }

    protected static function areScalars(array $array): bool
    {
        $scalars = array_filter($array, 'is_scalar');
        return count($scalars) == count($array);
    }

    protected static function exportKeyPair(array $array, $indent = 0): string
    {
        $nextIndent = $indent + 1;
        $result = "[" . self::newline();

        foreach ($array as $key => $value) {
            $result .= self::tabs($nextIndent)
                . "\"{$key}\" => " . self::exportValue($value, $nextIndent) . ","
                . (self::$inline ? " " : "") // space for inline array
                . self::newline();
        }

        $result .= self::tabs($indent) . "]";
        return $result;
    }


    protected static function newline(): string
    {
        return self::$inline ? "" : "\n";
    }

    protected static function tabs($n): string
    {
        return (self::$inline) ? "" : str_repeat(" ", $n * self::TAB_SIZE);
    }


    protected static function exportValue($value, $indent): string
    {
        if (is_null($value)) return "NULL";
        if (is_bool($value)) return $value ? "TRUE" : "FALSE";
        if (is_numeric($value)) return (string)$value;
        if (is_scalar($value)) return "\"" . addslashes($value) . "\"";

        if (($value instanceof Generator) || is_array($value)) return self::exporting($value, $indent);

        return "\"" . var_export($value, true) . "\"";
    }

}
