<?php

class Edge {
	
	private $fromNodeIndex;
	private $toNodeIndex;
	private $length;

	public function Edge($fromNodeIndex, $toNodeIndex, $length) {
		$this->fromNodeIndex = $fromNodeIndex;
		$this->toNodeIndex = $toNodeIndex;
		$this->length = $length;
	}

	public function getFromNodeIndex() {
		return $this->fromNodeIndex;
	}

	public function getToNodeIndex() {
		return $this->toNodeIndex;
	}

	public function getLength() {
		return $this->length;
	}

	public function getNeighbourIndex($nodeIndex) {
		if ($this->fromNodeIndex == $nodeIndex) {
			return $this->toNodeIndex;
		} else {
			return $this->fromNodeIndex;
		}
	}
			
}