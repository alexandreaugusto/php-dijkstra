<?php

require_once("Edge.php");
require_once("Node.php");

class Graph {
	
	private $nodes = array();

	private $noOfNodes;

	private $edges = array();

	private $noOfEdges;

	private $alphabet = "uvwxyzabcdefghijklmnopqrst";

	public function Graph($edges){

		$this->edges = $edges;

		$this->noOfNodes = $this->calculateNoOfNodes($edges);

		for ($n = 0; $n < $this->noOfNodes; $n++) {
			$this->nodes[$n] = new Node();
		}		
		
		$this->noOfEdges = count($edges);
		for ($edgeToAdd = 0; $edgeToAdd < $this->noOfEdges; $edgeToAdd++) {
			$tmp1 = $this->nodes[$edges[$edgeToAdd]->getFromNodeIndex()]->getEdges();
			$tmp2 = $this->nodes[$edges[$edgeToAdd]->getToNodeIndex()]->getEdges();

			array_push($tmp1, $edges[$edgeToAdd]);
			array_push($tmp2, $edges[$edgeToAdd]);

			$this->nodes[$edges[$edgeToAdd]->getFromNodeIndex()]->setEdges($tmp1);
			$this->nodes[$edges[$edgeToAdd]->getToNodeIndex()]->setEdges($tmp2);
		}
		
	}

	public function getNodes() {
		return $nodes;
	}
	
	public function getNoOfNodes() {
		return $noOfNodes;
	}
	
	public function getEdges() {
		return $edges;
	}
	
	public function getNoOfEdges() {
		return $noOfEdges;
	}

	private function calculateNoOfNodes($edges) {
		$noOfNodes = 0;
		foreach ($edges as $e) {
			if ($e->getToNodeIndex() > $noOfNodes) $noOfNodes = $e->getToNodeIndex();
			if ($e->getFromNodeIndex() > $noOfNodes) $noOfNodes = $e->getFromNodeIndex();
		}
		$noOfNodes++;

		return $noOfNodes;		
	}

	public function calculateShortestDistances() {
		
		$this->nodes[0]->setDistanceFromSource(0);
		$nextNode = 0;
		
		for ($i = 0; $i < count($this->nodes); $i++) {

			$currentNodeEdges = $this->nodes[$nextNode]->getEdges();
			for ($joinedEdge = 0; $joinedEdge < count($currentNodeEdges); $joinedEdge++) {

				$neighbourIndex = $currentNodeEdges[$joinedEdge]->getNeighbourIndex($nextNode);

				if (!$this->nodes[$neighbourIndex]->isVisited()) {

					$tentative = $this->nodes[$nextNode]->getDistanceFromSource() + $currentNodeEdges[$joinedEdge]->getLength();

					if ($tentative < $this->nodes[$neighbourIndex]->getDistanceFromSource()) {
						$this->nodes[$neighbourIndex]->setDistanceFromSource($tentative);
					}
					
				}
				
			}

			$this->nodes[$nextNode]->setVisited(true);

			$nextNode = $this->getNodeShortestDistanced();
		
		}

	}

	private function getNodeShortestDistanced() {
		
		$storedNodeIndex = 0;
		$storedDist = PHP_INT_MAX;
		
		for ($i = 0; $i < count($this->nodes); $i++) {
			$currentDist = $this->nodes[$i]->getDistanceFromSource();			
			if (!$this->nodes[$i]->isVisited() && $currentDist < $storedDist) {
				$storedDist = $currentDist;
				$storedNodeIndex = $i;
			}
			
		}
		
		return $storedNodeIndex;
	}
	
	public function toString() {

		$output = "Number of nodes = " . $this->noOfNodes;
		$output .= "\nNumber of edges = " . $this->noOfEdges;

		for ($i = 0; $i < count($this->nodes); $i++) {
			$output .= ("\r\nThe shortest distance from node u to node " . $this->alphabet{$i} . " is " . $this->nodes[$i]->getDistanceFromSource());
		}
		
		return $output . "\r\n\r\n";

	}

}
