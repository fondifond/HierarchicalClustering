<?php


namespace HierarchicalClustering\Links;

/**
 * Interface Link
 * @package HierarchicalClustering\Links
 * Getting optimal link of distances
 *
 * @author Gasanenko Denis <fondifonds@gmail.com>
 * @version 0.1
 */
interface Link{

    /**
     * Calculate optimal distance to link
     *
     * @param array $distances
     * @return float
     */
    public function calculate(array $distances);

}