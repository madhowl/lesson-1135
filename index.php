<?php
require('vendor/autoload.php');
use NoahBuscher\Macaw\Macaw;

Macaw::get('/', 'App\BlogClass@index');
Macaw::get('/(:any)', 'App\BlogClass@index');
Macaw::dispatch();





