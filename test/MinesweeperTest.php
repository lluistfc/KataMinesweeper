<?php
/**
 * Created by PhpStorm.
 * User: Zebrah
 * Date: 06/05/2016
 * Time: 19:08
 */

namespace Minesweeper;


class MinesweeperTest extends \PHPUnit_Framework_TestCase
{
    private $input;
    private $output;

    public function setUp()
    {
        $this->input = array(
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

        $this->output = array(
            array(
                array('*', '1', '0', '0'),
                array('2', '2', '1', '0'),
                array('1', '*', '1', '0'),
                array('1', '1', '1', '0'),
            ),
            array(
                array('*', '*', '1', '0', '0'),
                array('3', '3', '2', '0', '0'),
                array('1', '*', '1', '0', '0'),
            )
        );
    }

    /**
     * @test
     */
    public function testInput()
    {
        $this->assertNotEmpty($this->input);
    }

    public function testInputSize()
    {
        $ms = $this->createInput();
        $this->assertCount(3, $ms->getInput());
    }

    /**
     * @dataProvider inputDataProvider
     */
    public function testInputData()
    {
        $i = func_get_arg(0);
        $ms = $this->createInput();
        $maxRows = $ms->getInputMaxRows($i);
        $maxCols = $ms->getInputMaxCols($i);

        $data = $ms->getInputData($i);

        foreach ($data as $k => $v) {
            $this->assertCount($maxCols, $v, 'Se esperaban '.$maxCols.' Columnas y el tiene: '.count($v));
        }
        $this->assertCount($maxRows, $data, 'Se esperaban '.$maxRows.' Filas y el tiene: '.count($data));
    }

    public function testOutputSize()
    {
        $ms = $this->createInput();
        $data = $ms->preProcessData();

        $this->assertCount(2, $data);
    }

    public function testPositionHas2NearMines()
    {
        $ms = $this->createInput();
        $n = $ms->getNearMines(0, 2, 0);

        $this->assertEquals(2, $n);

    }

    public function testPositionHas3NearMines()
    {
        $ms = $this->createInput();
        $n = $ms->getNearMines(1, 2, 0);

        $this->assertEquals(3, $n);

    }

    public function testOutputData()
    {
        $ms = $this->createInput();
        $output = $ms->processData();

        $this->assertEquals($this->output, $output);
    }

    /**
     * @return Minesweeper
     */
    public function createInput()
    {
        $ms = new Minesweeper($this->input);
        return $ms;
    }

    public function inputDataProvider()
    {
        return array(
            array(0),
            array(1),
            array(2),
        );
    }
}
