<?php

require "head.php";

require "header.php";

global $USER, $RESULT;
if (!isset($USER)) {
    ?>
    <script>
        window.location.href = '/login.php';
    </script>
    <?
    die();
}
$id = $_GET['id'];
$level = $_GET['level'];

if (!isset($id)):?>
    <div class="alert alert-danger">Не найдена страница</div>
<?
else:
    $pTopic = getTopicById($id);

    if (!$pTopic):?>
        <div class="alert alert-danger">Не найден раздел</div>
        <?
        die();
    endif;

    function getBreadcrumbs($id, $arResult)
    {
        if ($id == '0') return $arResult;
        $topic = getTopicById($id);
        $arResult[$id] = [
            'title' => $topic['title'],
            'url' => "/topics.php?id={$topic['id']}&level={$topic['level']}",
        ];

        return getBreadcrumbs($topic['parent_id'], $arResult);
    }

    $breadcrumbs = getBreadcrumbs($id, []);

    ksort($breadcrumbs);

    ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Главная</a></li>
            <?
            foreach ($breadcrumbs as $key => $breadcrumb) {
                if ($key != $id) {
                    print_r("<li class=\"breadcrumb-item\"><a href=\"{$breadcrumb['url']}\">{$breadcrumb['title']}</a></li>");

                } else {
                    print_r("<li class=\"breadcrumb-item active\" aria-current=\"page\">{$breadcrumb['title']}</li>");
                }

            } ?>

        </ol>
    </nav>

    <h1 class="topicName"><?= $pTopic['title'] ?></h1>

    <div class="btn-group mb-3" role="group" aria-label="Basic example">
        <?
        if ($level == '3'):?>
            <a href="#" class="btn btn-primary addTheme" data-parent="<?= $_GET['id'] ?>">Добавить тему</a>
        <? else: ?>
            <a href="#" class="btn btn-primary addTopic" data-parent="<?= $_GET['id'] ?>"
               data-level="<?= intval($_GET['level']) + 1 ?>">Добавить подраздел</a>
        <? endif; ?>
    </div>

    <?
    if ($level == '3'):?>
        <div class="list-group" id="themesAll" data-parent="<?= $pTopic['id'] ?>">

        </div>
    <? else: ?>
        <div class="list-group" id="topicsAll" data-parent="<?= $pTopic['id'] ?>"
             data-level="<?= intval($_GET['level']) + 1 ?>">

        </div>
    <?endif; ?>
<?
endif;
require "footer.php";

?>