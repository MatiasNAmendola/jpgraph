<?php

class Sales {

    private $urlSalesData = 'http://www.redsnapper.net/devtestdata.json';

    public function getSalesData() {
        
        $jsonSalesData = file_get_contents($this->urlSalesData);
        $arraySalesData = json_decode($jsonSalesData, TRUE);
        
        return $arraySalesData;
    }
}
