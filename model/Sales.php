<?php

class Sales {

    private $urlSalesData = 'http://www.redsnapper.net/devtestdata.json';

    public function getSalesData() {
        
        $json = file_get_contents($this->urlSalesData);
        $salesData = json_decode($json, TRUE);
        
        return $salesData;
    }
}
