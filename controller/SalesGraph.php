<?php

require_once ('library/jpgraph/jpgraph.php');
require_once ('library/jpgraph/jpgraph_line.php');
require_once('model/Sales.php');

class SalesGraph extends Action {
    
    private $sales2011 = array();
    private $sales2012 = array();

    public function index() {

        $this->fetchGraphData();
        // set a variable for use in this view
        $this->setVar('graph', $this->setUpGraph());
    }

    private function fetchGraphData() {

        $sales = new Sales();
        $arraySalesData = $sales->getSalesData();
        $keys = array_keys($arraySalesData);

        foreach ($arraySalesData[$keys[0]] as $totalMonthSales) {
            $this->sales2011[] = $totalMonthSales;
        }
        foreach ($arraySalesData[$keys[1]] as $totalMonthSales) {
            $this->sales2012[] = $totalMonthSales;
        }
    }

    private function setUpGraph() {
        
        // create an array of months of the year
        for ($month = 1; $month <= 12; $month++) {
            $months[] = date("F", mktime(0, 0, 0, $month));
        }

        $width = 1200;
        $height = 400;
        $graph = new Graph($width, $height);
        $graph->SetScale('intint');
        $graph->title->Set('Redsnapper');
        $graph->subtitle->Set('Sales');
        $graph->xaxis->SetTitle('Months', "center");
        $graph->yaxis->title->Set('Sales');
        $graph->yaxis->title->SetMargin(25);
        $graph->xaxis->SetTickLabels($months);
        $graph->img->SetMargin(100, 100, 50, 100);
        $graph->SetFrame(true);
        $graph->SetShadow(true, 10, array(150, 150, 150));
        $graph->SetMarginColor("#F1F1F1");
        $lineplot2011 = new LinePlot($this->sales2011);
        $lineplot2012 = new LinePlot($this->sales2012);
        $lineplot2011->SetLegend('Sales 2011');
        $lineplot2012->SetLegend('Sales 2012');
        $graph->Add($lineplot2011);
        $graph->Add($lineplot2012);

        return $graph->Stroke();
    }

}

