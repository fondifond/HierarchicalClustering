<?php

include_once './vendor/autoload.php';
use \HierarchicalClustering\Links\SingleLink;

class SingleLinkTest extends \PHPUnit_Framework_TestCase
{

    public function testCalculate()
    {
        $link = new SingleLink();
        $this->assertInstanceOf('HierarchicalClustering\\Links\\Link', $link);
        $this->assertEquals(1, $link->calculate(array(1,2,3)));
        $this->assertNotEquals(3, $link->calculate(array(1,2,3)));
        $this->assertLessThan(max(array(1,2,3)), $link->calculate(array(1,2,3)));
    }
}