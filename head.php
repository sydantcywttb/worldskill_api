<?php

$USER = json_decode($_COOKIE['USER']);

function showError($message)
{
    print_r('<div class="error">' . $message . '</div>');
}

require "api.php";
?>