<?php
require_once '../lib/dispatcher.php';
require_once '../lib/view.php';

session_start();

$dispatcher = new Dispatcher();
$dispatcher->dispatch();
?>