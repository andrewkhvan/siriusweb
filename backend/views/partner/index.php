<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\LinkPager;

$this->title = Yii::t('app', 'Partners');

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="card">
    <div class="card-body">

<div class="d-flex">
    <div class="flex-grow-1">
    <?= $linkPager = LinkPager::widget([
        'pagination' => $pages,
        'maxButtonCount' => 5,
        'pageCssClass' => 'page-item',
        'linkOptions' => ['class' => 'page-link'],
        'disabledPageCssClass' => 'disabled page-link',
    ]) ?>
    </div>
</div>

<div class="table-responsive">
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'layout' => "{items}",
    'headerRowOptions' => ['class' => 'text-nowrap'],
    'columns' => [
        'Name',
        [
            'attribute' => 'Email',
            'format' => 'raw',
            'value' => function ($data) {
                return "$data->Email "
                    . Html::a('', ['user/partner-detail', 'partnerId' => $data->PartnerId], ['class' => 'mdi mdi-eye', 'target' => '_blank']) ;
            },
        ],
        'Phone',
        'BalanceWithdrawalBlocked:boolean',
        'RefBalanceWithdrawalBlocked:boolean',
        'AccountBlocked:boolean',
        'Rank',
        'RegistrationDate:datetime',
    ],
]) ?>
</div>

<div class="pager"><?= $linkPager ?></div>

    </div>
</div>