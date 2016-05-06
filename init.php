<?php
/**
 * Created by PhpStorm.
 * User: Zebrah
 * Date: 06/05/2016
 * Time: 21:26
 */

require_once 'vendor/autoload.php';
use Minesweeper\Minesweeper;

$input = array(
    array(
        array(4, 4),
        array('*', '.', '.', '.'),
        array('.', '.', '.', '.'),
        array('.', '*', '.', '.'),
        array('.', '.', '.', '.'),
    ),
    array(
        array(3, 5),
        array('*', '*', '.', '.', '.'),
        array('.', '.', '.', '.', '.'),
        array('.', '*', '.', '.', '.'),
    ),
    array(
        array(0, 0)
    )
);

$minesweep = new Minesweeper($input);

$minesweep->printOutput();