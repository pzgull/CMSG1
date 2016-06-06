<br><br><br><br>
<div class="notification" class="text-center">
    <?= $content ?>
</div>
<form action="/admin/?a=modifier&id=<?= $page->id ?>" method="POST">
    <div class="form-group">
        <label for="title">Nom de la page:</label>
        <input type="text" class="form-control" name="title"
               value="<?= $page->title ?>"
               required="required"/>
    </div>
    <div class="form-group">
        <label for="h1">Titre principal</label>
        <input type="text" class="form-control" name="h1"
               value="<?= $page->h1 ?>"
               required="required"/>
    </div>
    <div class="form-group">
        <p><label for="body">Contenu (HTML)</label></p>
        <textarea name="body" required="required" cols="80" row="15">
            <?= $page->body ?>
        </textarea>
        <p class="help-block">Balises autorisées: h2..5, p, a, em, strong</p>
    </div>
    <div class="form-group">
        <label for="label-text">Label (texte)</label>
        <input name="label-text"
               value="<?= $page->span_text ?>"
               required="required" />
    </div>
    <div class="form-group">
        <?= $labels ?>
    </div>
    <button type="submit" name="modifier" class="btn btn-success">Modifier</button>
</form>