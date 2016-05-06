<?php
/**
 * Created by PhpStorm.
 * User: Zebrah
 * Date: 06/05/2016
 * Time: 19:09
 */

namespace Minesweeper;


class Minesweeper
{
    private $input;

    private $data;
    /**
     * Input constructor.
     * @param $input
     */
    public function __construct($input)
    {
        $this->input = $input;
    }

    public function getInput()
    {
        return $this->input;
    }

    public function getInputMaxRows($int)
    {
        return $this->input[$int][0][0];
    }

    public function getInputMaxCols($int)
    {
        return $this->input[$int][0][1];
    }

    public function getInputData($int)
    {
        return array_slice($this->input[$int], 1);
    }

    public function preProcessData()
    {
        $preProcessedData = array();
        foreach ($this->input as $k => $v) {
            if ($v[0][0] !== 0 && $v[0][1] !== 0) {
                $preProcessedData[] = array_slice($v, 1);
            }
        }

        return $preProcessedData;
    }

    public function processData()
    {
        $preProcessedData = $this->preProcessData();
        $output = array();

        if (!empty($preProcessedData)) {
            foreach ($preProcessedData as $input => $inputData) {
                foreach ($inputData as $row => $rowData) {
                    foreach ($rowData as $k => $v) {
                        $output[$input][$row][$k] = $this->isMine($v)
                            ? '*'
                            : $this->getNearMines($inputData, $row, $k);
                    }
                }
            }
        }
        return $output;
    }

    public function printOutput()
    {
        $output = $this->processData();

        foreach ($output as $k => $field) {
            echo $this->printField($k, $field) . PHP_EOL;
        }
    }

    public function printField($k, $data)
    {
        $output = 'Field '.($k+1).':' . PHP_EOL;
        foreach ($data as $row => $values) {
            $output .= implode('', $values) . PHP_EOL;
        }

        return $output;
    }

    public function isMine($value)
    {
        return $value === '*' ? true : false;
    }

    public function getNearMines($input, $row, $col)
    {
        $n = 0;
        //checkTop
        if ($row > 0) {
            $data = $input[$row-1][$col];
            $n += $data === '*' ? 1 : 0;
        }
        //checkTopLeft
        if ($row > 0 && $col > 0) {
            $data = $input[$row-1][$col-1];
            $n += $data === '*' ? 1 : 0;
        }
        //checkTopRight
        if ($row > 0 && $col < (count($input[0])-1)) {
            $data = $input[$row-1][$col+1];
            $n += $data === '*' ? 1 : 0;
        }
        //checkBottom
        if ($row < (count($input)-1)) {
            $data = $input[$row+1][$col];
            $n += $data === '*' ? 1 : 0;
        }
        //checkBottomLeft
        if ($row < (count($input)-1)  && $col > 0) {
            $data = $input[$row+1][$col-1];
            $n += $data === '*' ? 1 : 0;
        }
        //checkBottomRight
        if ($row < (count($input)-1) && $col < (count($input[0])-1)) {
            $data = $input[$row+1][$col+1];
            $n += $data === '*' ? 1 : 0;
        }
        //checkLeft
        if ($col > 0) {
            $data = $input[$row][$col-1];
            $n += $data === '*' ? 1 : 0;
        }
        //checkRight
        if ($col < (count($input[0])-1)) {
            $data = $input[$row][$col+1];
            $n += $data === '*' ? 1 : 0;
        }

        return $n;
    }
}