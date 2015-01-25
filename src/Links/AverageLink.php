<?php

namespace HierarchicalClustering\Links;

/**
 * Class AverageLink
 * @package HierarchicalClustering\Links
 * Getting link by average value in distances
 *
 * @author Gasanenko Denis <fondifonds@gmail.com>
 * @version 0.1
 */
class AverageLink implements Link{

    /**
     * @inheritdoc
     */
    public function calculate(array $distances){
        $sum = array_sum($distances);
        return $sum / count($distances);
    }

}