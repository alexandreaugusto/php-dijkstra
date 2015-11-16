<?php

require_once("Edge.php");
require_once("Node.php");
require_once("Graph.php");

	
		// Define the edges of the graph

		$edges = array(
				new Edge(0,1,2),
				new Edge(0,2,5),
				new Edge(0,3,1),
				new Edge(1,2,3),
				new Edge(1,3,2),
				new Edge(2,3,3),
				new Edge(2,4,1),
				new Edge(2,5,5),
				new Edge(3,4,1),
				new Edge(4,5,2)
			);
		
		// Create the graph
		
		$graph = new Graph($edges);
		
		// Update the graph with the shortest distances
		
		$graph->calculateShortestDistances();
		
		// Display the graph
		
		print $graph->toString();