<tr>
    <td>#<?= $page->id ?></td>
    <td><?= $page->title ?></td>
    <td><?= $page->slug ?></td>
    <td>
        <a href="/admin/?a=details&id=<?= $page->id ?>" class="btn btn-default">
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
        <a href="/admin/?a=modifier&id=<?= $page->id ?>" class="btn btn-warning">
            <i class="glyphicon glyphicon-pencil"></i>
        </a>
        <a href="/admin/?a=supprimer&id=<?= $page->id ?>" class="btn btn-danger">
            <i class="glyphicon glyphicon-trash"></i>
        </a>
    </td>
</tr>