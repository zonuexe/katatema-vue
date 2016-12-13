<?php

$loader = require __DIR__ . '/../vendor/autoload.php';

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}
