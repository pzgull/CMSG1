<div class="jumbotron">
    <h1><?= $content->h1 ?></h1>
    <p><?= $content->body ?></p>
    <span class="label <?= $content->span_class ?>"><?= $content->span_text ?></span>
</div>
<img class="img-thumbnail" alt="<?= $content->title ?>" src="<?= PUBLIC_DIR . 'img/' . $content->img ?>" data-holder-rendered="true">