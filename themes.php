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

if (!isset($id)):?>
    <div class="alert alert-danger">Не найдена страница</div>
<?
else:

    $pTheme = getThemeById($id);

    if (!$pTheme):?>
        <div class="alert alert-danger">Не найдена тема</div>
        <?
        die();
    endif;

    $pTopic = getTopicById($pTheme['parent_id']);

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

    $breadcrumbs = getBreadcrumbs($pTopic['id'], []);

    ksort($breadcrumbs);

    ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Главная</a></li>
            <?
            foreach ($breadcrumbs as $key => $breadcrumb) {
                print_r("<li class=\"breadcrumb-item\"><a href=\"{$breadcrumb['url']}\">{$breadcrumb['title']}</a></li>");

            } ?>
            <li class="breadcrumb-item active" aria-current="page"><?= $pTheme['title'] ?></li>
        </ol>
    </nav>

    <h1 class="topicName"><?= $pTheme['title'] ?></h1>
    <div class="text">
        <p>
            <?= $pTheme['content'] ?>
        </p>
        <p>
            Тип темы: <?
            $themeType = '';
            switch ($pTheme['type']) {
                case 'public':
                    $themeType = 'Публичная';
                    break;
                case 'private':
                    $themeType = 'Закрытая';
                    break;
                case 'info':
                    $themeType = 'Информационная';
                    break;
            }
            print_r($themeType);

            ?>
        </p>
    </div>

    <div class="btn-group mb-3" role="group" aria-label="Basic example">
        <a href="#" class="btn btn-primary addMessage" data-parent="<?= $_GET['id'] ?>">Добавить сообщение</a>
        <a href="#" class="btn btn-link editTheme" data-id="<?= $_GET['id'] ?>">Редактировать тему</a>
        <a href="#" class="btn btn-link linkTheme" data-id="<?= $_GET['id'] ?>">Ссылка на тему</a>
        <a href="#" class="btn btn-link addThemeUser" data-id="<?= $_GET['id'] ?>">Добавить участника</a>

    </div>

    <hr>

    <div class="user-list">
        <h3>Участники</h3>
        <div class="list-group" id="themeUsersAll" data-id="<?= $pTheme['id']?>">
            Не найдено
        </div>
        <hr>
    </div>

    <div class="list-group" id="messagesAll" data-parent="<?= $pTheme['id'] ?>">

    </div>
<?
endif;
require "footer.php";

?>