<?php

//Example php code
require __DIR__ . '/vendor/autoload.php';

use AlexGrizzled\ConvertPhone;

$phone = new ConvertPhone('tel:81234567890');

echo $phone->getNumber() . PHP_EOL;
echo $phone->getReadable() . PHP_EOL;