<?php
namespace HierarchicalClustering\Links;

/**
 * Class CompleteLink
 * @package HierarchicalClustering\Links
 * Getting link by max value in distances
 *
 * @author Gasanenko Denis <fondifonds@gmail.com>
 * @version 0.1
 */
class CompleteLink implements Link{

    /**
     * @inheritdoc
     */
    public function calculate(array $distances){
        return max($distances);
    }

}