<?php

set_include_path(
    get_include_path()
    .PATH_SEPARATOR."./src/controllers/"
    .PATH_SEPARATOR."./src/models/"
    .PATH_SEPARATOR."./src/repository/"
);

spl_autoload_register(function ($class_name) {
    require_once $class_name . ".php";
});