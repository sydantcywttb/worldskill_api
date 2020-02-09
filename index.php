<?php

require "head.php";

require "header.php";

global $USER;
if(!isset($USER)) {
    ?>
    <script>
        window.location.href = '/login.php';
    </script>
    <?
    die();
}
?>

    <h1>Приветсвуем вас на сайте</h1>

    <div class="btn-group mb-3" role="group" aria-label="Basic example">
        <a href="#" class="btn btn-primary addTopic" data-parent="0" data-level="1">Добавить раздел</a>
    </div>
    <div class="list-group" id="topicsAll" data-parent="0" data-level="1">

    </div>
<?
require "footer.php";

?>