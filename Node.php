<?php

class Node {
	
	private $distanceFromSource = PHP_INT_MAX;
	private $visited = false;
	private $edges = array();

	public function getDistanceFromSource() {
		return $this->distanceFromSource;
	}

	public function setDistanceFromSource($distanceFromSource) {
		$this->distanceFromSource = $distanceFromSource;
	}

	public function isVisited() {
		return $this->visited;
	}

	public function setVisited($visited) {
		$this->visited = $visited;
	}

	public function getEdges() {
		return $this->edges;
	}

	public function setEdges($edges) {
		$this->edges = $edges;
	}

}