<?php

namespace HierarchicalClustering\Distances;

/**
 * Interface Distance
 * @package HierarchicalClustering\Distances
 * Getting distance between points
 *
 * @author Gasanenko Denis <fondifonds@gmail.com>
 * @version 0.1
 */
interface Distance{

    /**
     * Calculate distance
     *
     * @param array $a
     * @param array $b
     * @return float
     */
    public function calculate(array $a, array $b);

}