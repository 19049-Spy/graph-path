<?php
class Graph {
    private $adjacencyList;

    public function __construct() {
        $this->adjacencyList = [];
    }

    public function addEdge($vertex1, $vertex2) {
        if (!isset($this->adjacencyList[$vertex1])) {
            $this->adjacencyList[$vertex1] = [];
        }
        $this->adjacencyList[$vertex1][] = $vertex2;

        if (!isset($this->adjacencyList[$vertex2])) {
            $this->adjacencyList[$vertex2] = [];
        }
        $this->adjacencyList[$vertex2][] = $vertex1;
    }

    public function hasPath($start, $end) {
        $visited = [];
        return $this->dfs($start, $end, $visited);
    }

    private function dfs($current, $end, &$visited) {
        if ($current === $end) {
            return true;
        }

        $visited[$current] = true;

        if (isset($this->adjacencyList[$current])) {
            foreach ($this->adjacencyList[$current] as $neighbor) {
                if (!isset($visited[$neighbor]) && $this->dfs($neighbor, $end, $visited)) {
                    return true;
                }
            }
        }

        return false;
    }
}

// Usage example
$graph = new Graph();
$graph->addEdge('A', 'B');
$graph->addEdge('B', 'C');
$graph->addEdge('B', 'D');
$graph->addEdge('C', 'E');
$graph->addEdge('D', 'F');

$source = 'A';
$destination = 'E';

if ($graph->hasPath($source, $destination)) {
    echo "Path exists between $source and $destination.";
} else {
    echo "No path exists between $source and $destination.";
}
?>
