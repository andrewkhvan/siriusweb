<?php

use yii\helpers\Url;
use backend\models\Transaction;

$get_filter = Yii::$app->request->get('filter');

?>
<div class="product-search">

    <div class="btn-group">
        <button class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"><?= Yii::t('app', 'Filter') ?></button>
        <ul class="dropdown-menu">
            <li><a href="<?= Url::to(['cabinet/transactions']) ?>" class="dropdown-item"><?= Yii::t('app', 'All transactions') ?></a></li>
        <?php foreach (Transaction::getFilterList() as $key => $item): ?>
            <li><a href="<?= Url::to(['cabinet/transactions', 'filter' => $key]) ?>" class="dropdown-item<?= ($key == $get_filter) ? ' active':'' ?>"><?= $item ?></a></li>
        <?php endforeach; ?>
        </ul>
    </div>

</div>
