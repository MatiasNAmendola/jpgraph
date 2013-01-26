<?php

require_once ('library/jpgraph/jpgraph.php');
require_once ('library/jpgraph/jpgraph_line.php');
require_once('model/Sales.php');

class SalesGraph extends Action {

    private $months = array();
    private $sales2011 = array();
    private $sales2012 = array();

    public function index() {
        
        for ($month = 1; $month <= 12; $month++) {
            $this->months[] = date("F", mktime(0, 0, 0, $month));
        }
        
        $this->fetchGraphData();
        $this->setVar('graph', $this->setUpGraph());
    }

    private function fetchGraphData() {
        
        $sales = new Sales();
        $salesData = $sales->getSalesData();
        $keys = array_keys($salesData);
        
        foreach ($salesData[$keys[0]] as $totalMonthSales) {
            $this->sales2011[] = $totalMonthSales;
        }
        foreach ($salesData[$keys[1]] as $totalMonthSales) {
            $this->sales2012[] = $totalMonthSales;
        }
    }

    private function setUpGraph() {
        
        $width = 1000;
        $height = 400;
        $graph = new Graph($width, $height);
        $graph->SetScale('intint');
        $graph->title->Set('Sales');
        $graph->xaxis->title->Set('Months');
        $graph->xaxis->SetLabelAngle(50);
        $graph->yaxis->title->Set('(sales)');
        $graph->xaxis->SetTickLabels($this->months);
        $graph->img->SetMargin(60,20,35,75);
        $lineplot1 = new LinePlot($this->sales2011);
        $lineplot2 = new LinePlot($this->sales2012);
        $graph->Add($lineplot1);
        $graph->Add($lineplot2);
        $renderedGraph = $graph->Stroke();
        
        return $renderedGraph;
    }

}

