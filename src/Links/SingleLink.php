<?php
namespace HierarchicalClustering\Links;

/**
 * Class SingleLink
 * @package HierarchicalClustering\Links
 * Getting link by min value in distances
 *
 * @author Gasanenko Denis <fondifonds@gmail.com>
 * @version 0.1
 */
class SingleLink implements Link{

    /**
     * @param array $distances
     * @return mixed
     */
    public function calculate(array $distances){
        return min($distances);
    }

}