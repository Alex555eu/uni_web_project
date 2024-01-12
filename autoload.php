<?php

set_include_path(
    get_include_path()
    .PATH_SEPARATOR."./src/controllers/"
);

spl_autoload_register(function ($class_name) {
    require_once $class_name . ".php";
});