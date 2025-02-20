<?php
/** @var yii\web\View $this */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <th class="sorting sorting_asc">Date</th>
                <th class="sorting sorting_asc">Operation</th>
                <th class="sorting sorting_asc">Bonus</th>
                <th class="sorting sorting_asc">Sum</th>
                <th class="sorting sorting_asc">refPartner</th>
            </thead>
            <tbody>
            <?php foreach ($data->rows as $row): ?>
                <tr>
                    <td><?= date('m/d/Y H:i:s', $row->Date) ?></td>
                    <td><?= $row->Operation ?></td>
                    <td>
                        <?= $row->Bonus ?>
                    </td>
                    <td>
                        <?= number_format($row->Sum, 2) ?>
                    </td>
                    <td><?= $row->refPartner ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
