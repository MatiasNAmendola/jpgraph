<?php

require_once "controller/front.php";
$front = new Front();

try {
    $front->dispatch();
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
}