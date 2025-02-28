<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Operations');

?>
<div class="card">
    <div class="card-body">
        <?php Pjax::begin(); ?>

        <div class="d-flex">
            <div class="flex-grow-1">
            <?= $linkPager = LinkPager::widget([
                'pagination' => $pages,
                'pageCssClass' => 'page-item',
                'linkOptions' => ['class' => 'page-link'],
                'disabledPageCssClass' => 'disabled page-link',
            ]) ?>
            </div>
            <div class="flex-shrink-0">
                <?= $this->render('_search'); ?>
            </div>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}",
            'columns' => [
                'Date:datetime',
                'DocNo',
                'Status',
                'Operation',
                'DocSum',
                'PartnerId',
                'PartnerName',
                'PartnerEmail',
                'Investment',
                'RefBalance:boolean',
                'Virtual:boolean',
                'WAddress',
            ],
        ]) ?>

        <?= $linkPager ?>

        <?php Pjax::end(); ?>
    </div>
</div>
