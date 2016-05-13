<?php
include APP_VIEW_DIR . '/header.php';
include APP_VIEW_DIR . '/nav.php';
?>
<div class="container theme-showcase" role="main">
    <div class="jumbotron">
        <h1><?= $content->h1 ?></h1>
        <p><?= $content->body ?></p>
        <span class="label <?= $content->span_class ?>"><?= $content->span_text ?></span>
    </div>
    <img class="img-thumbnail" alt="<?= $content->title ?>" src="img/<?= $content->img ?>" data-holder-rendered="true">
</div>
<?php
include APP_VIEW_DIR . '/footer.php';