<?php

use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\LinkPager;


$this->title = 'View partner detail';

?>
<div class="row">
    <div class="col-12">
        <?= $this->render('//cabinet/transactions', [
            'dataProvider' => $dataProvider,
            'pages' => $pages,
        ]) ?>
    </div>
</div>