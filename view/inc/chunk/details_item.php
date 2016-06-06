<a href="/admin/?=modifier&id=<?= $data->id ?>" class="btn btn-primary">
    <i class="glyphicon glyphicon-pencil"></i>&nbsp;Modifier
</a>
<a href="/admin/?=supprimer&id=<?= $data->id ?>" class="btn btn-danger">
    <i class="glyphicon glyphicon-trash"></i>&nbsp;Supprimer
</a>
<tr>
    <td>ID</td>
    <td><?= $data->id ?></td>
</tr>
<tr>
    <td>Title</td>
    <td><?= $data->title ?></td>
</tr>
<tr>
    <td>Slug</td>
    <td><?= $data->slug ?></td>
</tr>
<tr>
    <td>H1</td>
    <td><?= $data->h1 ?></td>
</tr>
<tr>
    <td>Body</td>
    <td>
        <pre><?= $data->body ?></pre>
    </td>
</tr>
<tr>
    <td>Label</td>
    <td>
        <span class="label <?= $data->span_class ?>">
            <?= $data->span_text ?>
        </span>
    </td>
</tr>
<tr>
    <td>Image</td>
    <td>
        <img class="thumbnail" src="<?= PUBLIC_DIR . 'img/' . $data->img ?>" width="150">
    </td>
</tr>