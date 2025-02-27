<?php
/** @var yii\web\View $this */

use \yii\widgets\LinkPager;

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="card">
    <div class="card-body">

<div class="dataTables_wrapper">
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Operation</th>
                <th>Bonus</th>
                <th>Sum</th>
                <th>refPartner</th>
            </tr>
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

    <div class="dataTables_paginate">
        <?= LinkPager::widget([
            'pagination' => $pages,
            'pageCssClass' => 'page-item',
            'linkOptions' => ['class' => 'page-link'],
            'disabledPageCssClass' => 'disabled page-link',
        ]) ?>
    </div>
</div>

    </div>
</div>
