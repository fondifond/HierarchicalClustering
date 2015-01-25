<?php

include_once './vendor/autoload.php';
use \HierarchicalClustering\Links\CompleteLink;

class CompleteLinkTest extends \PHPUnit_Framework_TestCase
{

    public function testCalculate()
    {
        $link = new CompleteLink();
        $this->assertInstanceOf('HierarchicalClustering\\Links\\Link', $link);
        $this->assertEquals(3, $link->calculate(array(1,2,3)));
        $this->assertNotEquals(1, $link->calculate(array(1,2,3)));
        $this->assertGreaterThan(min(array(1,2,3)), $link->calculate(array(1,2,3)));
    }
}