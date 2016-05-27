<tr>
    <td><?= $page->title ?></td>
    <td><?= $page->slug ?></td>
    <td>
        <a href="/admin/?a=details" class="btn btn-default">
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
        <a href="/admin/?a=modifier" class="btn btn-warning">
            <i class="glyphicon glyphicon-pencil"></i>
        </a>
        <a href="/admin/?a=supprimer" class="btn btn-danger">
            <i class="glyphicon glyphicon-trash"></i>
        </a>
    </td>
</tr>