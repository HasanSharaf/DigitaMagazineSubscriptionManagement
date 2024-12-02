<?php

namespace App\Utilities\Formula;

use Illuminate\Support\Arr;

class FormulaOperands
{
    private static array $operands = [
        [
            'value' => 'basic_salary',
            'label' => 'Base Salary',
            'symbol' => 'a',
        ],
        [
            'value' => 'housing_allowance',
            'label' => 'Housing Allowance',
            'symbol' => 'b',
        ],
        [
            'value' => 'mobile_allowance',
            'label' => 'Mobile Allowance',
            'symbol' => 'c',
        ],
        [
            'value' => 'driving_allowance',
            'label' => 'Driving Allowance',
            'symbol' => 'd',
        ],
        [
            'value' => 'other_allowance',
            'label' => 'Other Allowance',
            'symbol' => 'k',
        ],
        [
            'value' => 'working_hours',
            'label' => 'Working Hours',
            'symbol' => 'f',
        ],
        [
            'value' => 'total_salary',
            'label' => 'Total Salary',
            'symbol' => 'g',
        ],
        [
            'value' => 'basic_per_hour',
            'label' => 'Basic Per Hour',
            'symbol' => 'h',
        ],
        [
            'value' => 'total_per_hour',
            'label' => 'Total Per Hour',
            'symbol' => 'i',
        ],
        [
            'value' => 'transportation_allowance',
            'label' => 'Transportation Allowance',
            'symbol' => 'j',
        ],
        [
            'value' => 'number_of_overtime_hours',
            'label' => 'Number of Overtime Hours',
            'symbol' => 'z',
        ],
    ];

    private static array $operations = [
        [
            'value' => '*',
            'label' => '*'
        ],
        [
            'value' => '/',
            'label' => '/'
        ],
        [
            'value' => '+',
            'label' => '+'
        ],
        [
            'value' => '-',
            'label' => '-'
        ],
    ];

    public static function getVariablesWithTestingValues(): array
    {
        return Arr::mapWithKeys(self::$operands, function ($item) {
            return [$item['symbol'] => $item['dummy_value']];
        });
    }

    public static function getAllowedOperands(): array
    {
        return array_column(self::$operands, 'symbol');
    }

    public static function getListOfOperands(): array
    {
        return self::$operands;
    }

    public static function indexOperandsList(): array
    {
        return Arr::map(self::$operands, function ($op) {
            return [
                'value' => $op['symbol'],
                'label' => $op['label'],
            ];
        });
    }

    public static function indexOperationsList(): array
    {
        return self::$operations;
    }

    public static function mapValueToSymbol($value)
    {
        $item = Arr::first(array_filter(self::$operands, function ($op) use ($value) {
            return $op['value'] == $value;
        }));

        if (isset($item)) {
            return $item['symbol'];
        }

        return null;
    }

    public static function mapValuesToSymbols($values): array
    {
        return array_map(function ($item) {
            return Arr::first(Arr::where(
                self::$operands,
                function ($operand) use ($item) {
                    return $operand['value'] == $item;
                }
            ))['symbol'];
        }, $values);
    }

}
