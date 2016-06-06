<br><br><br><br>
<div class="notification" class="text-center">
    <?= $content ?>
</div>
<form action="/admin/?a=ajouter" method="POST">
    <div class="form-group">
        <label for="title">Nom de la page:</label>
        <input type="text" class="form-control" name="title" required="required"/>
    </div>
    <div class="form-group">
        <label for="h1">Titre principal</label>
        <input type="text" class="form-control" name="h1" required="required"/>
    </div>
    <div class="form-group">
        <p><label for="body">Contenu (HTML)</label></p>
        <textarea name="body" required="required" cols="80" row="15"></textarea>
        <p class="help-block">Balises autorisées: h2..5, p, a, em, strong</p>
    </div>
    <div class="form-group">
        <label for="label-text">Label (texte)</label>
        <input name="label-text" required="required" />
    </div>
    <div class="form-group">
        <label class="radio-inline">
            <input type="radio" name="label-type" value="label-default">
            <span class="label label-default">default</span>
        </label>
        <label class="radio-inline">
            <input type="radio" name="label-type" value="label-success">
            <span class="label label-success">success</span>
        </label>
        <label class="radio-inline">
            <input type="radio" name="label-type" value="label-warning">
            <span class="label label-warning">warning</span>
        </label>
        <label class="radio-inline">
            <input type="radio" name="label-type" value="label-danger">
            <span class="label label-danger">danger</span>
        </label>
    </div>
    <button type="submit" name="ajouter" class="btn btn-success">Ajouter</button>
</form>