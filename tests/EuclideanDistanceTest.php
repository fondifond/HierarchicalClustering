<?php
include_once './vendor/autoload.php';
use \HierarchicalClustering\Distances\EuclideanDistance;

class EuclideanDistanceTest extends \PHPUnit_Framework_TestCase
{
    public function testCalculate()
    {
        $distance = New EuclideanDistance();
        $this->assertInstanceOf('HierarchicalClustering\\Distances\\Distance', $distance);
        $this->assertEquals(0, $distance->calculate(array(1,1,1),array(1,1,1)));
        $this->assertNotEquals(0, $distance->calculate(array(1,1,1),array(2,2,2)));
        $this->assertGreaterThan(0, $distance->calculate(array(1,1,1),array(1,2,3)));
    }
}