<?php

define('ROOT', __DIR__);

function __autoload($class) {
    include ROOT.DIRECTORY_SEPARATOR.$class.".php";
}
