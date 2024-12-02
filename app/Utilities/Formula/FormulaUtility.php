<?php

namespace App\Utilities\Formula;

use Exception;
use MathParser\Interpreting\Evaluator;
use MathParser\Interpreting\LaTeXPrinter;
use MathParser\StdMathParser;

class FormulaUtility
{

    /**
     * @param array $possible_operands
     * @param string|null $formula
     * @return array
     *
     * @description this function is responsible for checking what are the
     *              existing operands (variables) in the array.
     */
    public static function getExistingOperands(
        array       $possible_operands,
        string|null $formula
    ): array
    {

        $operands = array();

        if (!isset($formula)) {
            return $operands;
        }

        // for each possible operand, check for existence.
        foreach ($possible_operands as $operand) {

            // if the operand exists, add it to the existing operands list.
            if (str_contains($formula, $operand)) {
                $operands[] = $operand;

            }
        }

        // remove duplicated operands.
        return array_unique($operands);
    }

    public static function evaluateFormula(
        string|null $formula,
        array       $variables_values,  // example: [ 'a' => 214.42, 'b' => 350.32 ]
    ): ?array
    {

        if (!isset($formula)) {
            return null;
        }

        try {

            // define the formula parser
            $parser = new StdMathParser();

            // Generate an abstract syntax tree
            $AST = $parser->parse($formula);

            // evaluator visitor instance
            $evaluator = new Evaluator();
            $evaluator->setVariables($variables_values);

            $result = $AST->accept($evaluator);
            return [
                0 => "done",
                1 => $result
            ];

        } catch (Exception $e) {
            return [
                0 => "error",
                1 => $e->getMessage()
            ];
        }
    }

    /**
     * @param string $formula
     * @return string|null
     * @description this function takes the string formula
     *              and format it as LaTex. and return the result.
     */
    public static function formatFormulaAsLaTex(
        string|null $formula,
    ): ?string
    {
        if (!isset($formula)) {
            return null;
        }

        try {

            // define the formula parser
            $parser = new StdMathParser();

            // Generate an abstract syntax tree
            $AST = $parser->parse($formula);

            $latexPrinter = new LaTeXPrinter();

            return $AST->accept($latexPrinter);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
