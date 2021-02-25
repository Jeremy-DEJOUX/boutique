<?php
use App\Autoloader;

use App\Test\Test;

require_once 'classes/Autoloader.php';
Autoloader::register();

$new = new Test;
$new->test();
