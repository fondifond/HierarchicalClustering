<?php

require_once 'vendor/autoload.php';

use \HierarchicalClustering\Clustering;
use \HierarchicalClustering\Links\AverageLink;
use \HierarchicalClustering\Distances\EuclideanDistance;

$input = [
    [1,2,3],
    [2,2,2],
    [3,2,1],
    [4,2,3],
    [2,4,2],
    [3,2,4],
    [5,2,4],
    [2,5,2],
    [4,2,5],
];

$object = new Clustering(
    $input,
    new EuclideanDistance(),
    new AverageLink()
);
$clusters = $object->getCluster();

var_dump($clusters);
