<?php

include_once './vendor/autoload.php';
use \HierarchicalClustering\Links\AverageLink;

class AverageLinkTest extends \PHPUnit_Framework_TestCase
{
    public function testCalculate()
    {
        $link = new AverageLink();
        $this->assertInstanceOf('HierarchicalClustering\\Links\\Link', $link);
        $this->assertEquals(2, $link->calculate(array(1,2,3)));
        $this->assertNotEquals(1, $link->calculate(array(1,2,3)));
    }
}