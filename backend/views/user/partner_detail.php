<?php

use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\LinkPager;


$this->title = "Partner stats | {$info->getPartnerName()}, {$info->email}";

$this->params['breadcrumbs'][1] = Yii::t('app', 'Operations');
$this->params['breadcrumbs'][2] = Yii::t('app', 'Partner stats');

?>
<div class="row">
    <div class="col-sm-12 col-md-5">
        <?= $this->render('partner_info', ['data' => $info]) ?>
        <?= $this->render('//cabinet/_ranking_system', ['data' => $info]);  ?>
        <?= $this->render('//cabinet/_info_statistics', ['data' => $info]);  ?>
    </div>
    <div class="col-sm-12 col-md-7">
        <?= $this->render('partner_state_form', ['model' => $model]) ?>
        <?= $this->render('partner_deposits', ['data' => $deposits]) ?>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?= $this->render('//cabinet/transactions', [
            'dataProvider' => $dataProvider,
            'pages' => $pages,
        ]) ?>
    </div>
</div>
