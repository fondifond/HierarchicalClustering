<?php

namespace HierarchicalClustering;

/**
 * Class Clustering
 * @package HierarchicalClustering
 * Creating simple hierarchical clustering
 *
 * @author Gasanenko Denis <fondifonds@gmail.com>
 * @version 0.1
 */
class Clustering{

    /** @var array|null  */
    private $input = null;
    /**
     * @var Distances\Distance|null
     */
    private $distance = null;
    /**
     * @var Links\Link|null
     */
    private $linkage = null;
    /**
     * @var int
     */
    private $maxClusters = 3;

    /**
     * @var array|null
     */
    private $distances = null;
    /**
     * @var array
     */
    private $links = array();
    /**
     * @var array
     */
    private $clusters = array();
    /**
     * @var array
     */
    private $levels = array();

    /**
     * Constructor of Clustering class
     *
     * @param array $input
     * @param object Distances\Distance $distance
     * @param object Links\Link $linkage
     * @param int $maxClusters
     * @return object
     */
    public function __construct(array $input, Distances\Distance $distance, Links\Link $linkage, $maxClusters = 3){
        $this->input = $input;
        $this->distance = $distance;
        $this->linkage = $linkage;
        $this->maxClusters = $maxClusters;

        $this->distances = $this->initDistances($this->input);
        $this->clusters = $this->initClusters(count($this->input));

        $level = array(
            'linkage' => null,
            'clusters'=> $this->clusters
        );
        $this->levels = array($level);
        while (count($this->clusters) > $this->maxClusters) {
            $this->reduce();
        }
        return $this;
    }

    /**
     * Initializing clusters array
     *
     * @param integer $count
     * @return array
     */
    private function initClusters($count){
        $clusters = array();
        for ($i = 0; $i < $count; $i++)
            array_push($clusters, array($i));

        return $clusters;
    }

    /**
     * Initializing distances array
     *
     * @param array $input
     * @return array
     */
    private function initDistances($input){
        $length = count($input);
        $matrix = array();
        for($i = 0; $i < $length; $i++){
            for($j = 0; $j < $i; $j++){
                $matrix[$i][$j] = $this->distance->calculate($input[$i], $input[$j]);
            }
        }
        return $matrix;
    }

    /**
     * Get distance of two points in distances matrix
     *
     * @param array $distances
     * @param integer $i
     * @param integer $j
     * @return float
     */
    private function distanceOf(array $distances, $i, $j){
        if($i > $j) return $distances[$i][$j];
        return $distances[$j][$i];
    }

    /**
     * Reduce clusters values
     *
     * @return array
     */
    private function reduce(){
        $clusters = $this->clusters;
        $count = count($clusters);
        $min = null;
        $j = 0;
        for($i = 0; $i < $count; $i++){
            for($j = 0; $j < $i; $j++){
                $linkage = $this->linkageOf($clusters[$i], $clusters[$j]);

                if(!$min || $linkage < $min['linkage']){
                    $min = array(
                        'linkage' => $linkage,
                        'i' => $i,
                        'j' => $j
                    );
                }
            }
        }

        $this->clusters[$min['i']] = array_merge($this->clusters[$min['i']], $this->clusters[$min['j']]);
        array_splice($this->clusters, $min['j'], 1);
        $level = array(
            'linkage' => $min['linkage'],
            'clusters' => $this->clusters,
            'from' => $i,
            'to' => $j
        );
        array_push($this->levels, $level);

        return $level;
    }

    /**
     * Get optimal link value to clusters
     *
     * @param array $clusterA
     * @param array $clusterB
     * @return float
     */
    private function linkageOf($clusterA,$clusterB){
        $hash = count($clusterA) > count($clusterB) ?
            implode(',' ,$clusterA) . ' - ' . implode(',' ,$clusterB) :
            implode(',' ,$clusterB) . ' - ' . implode(',' ,$clusterA);
        if(in_array($hash, $this->links, true)) return $this->links[$hash];

        $distances = array();
        $countA = count($clusterA);
        $countB = count($clusterB);
        for($i = 0; $i < $countA; $i++){
            for($j = 0; $j < $countB; $j++){
                array_push($distances, $this->distanceOf($this->distances, $clusterA[$i], $clusterB[$j]));
            }
        }
        $this->links[$hash] = $this->linkage->calculate($distances);
        return $this->links[$hash];
    }

    /**
     * Get last cluster of hierarchy
     *
     * @return array
     */
    public function getCluster(){
        $level = count($this->levels)-1;
        return $this->levels[$level]['clusters'];
    }

}