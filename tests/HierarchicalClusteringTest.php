<?php

include_once './vendor/autoload.php';
use \HierarchicalClustering\Clustering;
use \HierarchicalClustering\Links\AverageLink;
use \HierarchicalClustering\Distances\EuclideanDistance;

class HierarchicalClusteringTest extends \PHPUnit_Framework_TestCase
{

    private $fixture;
    private $input = array(
        array(1,2,3),
        array(2,2,2),
        array(3,2,1),
    );

    public function setUp(){
        $this->fixture = New Clustering($this->input, new EuclideanDistance(), new AverageLink());
    }

    public function tearDown(){
        $this->fixture = NULL;
    }

    function testInitClusters(){
        $initClusters = self::getMethod('initClusters');
        $clusters = $initClusters->invokeArgs($this->fixture, array(3));
        $this->assertInternalType('array', $clusters);
        $this->assertEquals(array(array(0),array(1),array(2)), $clusters);
        $this->assertNotEquals(array(array(1,0),array(2,1),array(3,2)), $clusters);
    }

    public function testInitDistances(){
        $initDistances = self::getMethod('initDistances');
        $distances = $initDistances->invokeArgs($this->fixture, array($this->input));
        $this->assertInternalType('array',$distances);
        $this->assertCount(count($this->input)-1, $distances);
    }

    /**
     * @dataProvider providerDistanceOf
     */
    public function testDistanceOf($x, $y, $value){
        $distanceOf = self::getMethod('distanceOf');
        $distance = $distanceOf->invokeArgs($this->fixture, array(array(array(1, 2),array(3,4)),$x,$y));

        $this->assertEquals($value, $distance);
    }

    public function providerDistanceOf ()
    {
        return array (
            array (0, 0, 1),
            array (0, 1, 3),
            array (1, 0, 3)
        );
    }

    protected static function getMethod($name) {
        $class = new ReflectionClass('HierarchicalClustering\\Clustering');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

}