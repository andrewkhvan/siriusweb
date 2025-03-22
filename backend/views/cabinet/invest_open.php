<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\Pjax;

?>
<?php Pjax::begin() ?>

<h2 class="text-center text-success-emphasis"><i class="bx bx-pie-chart bx-lg"></i></h2>
<h4 class="text-center fs-1 mb-3" id="inv-title"><?= $model->InvestmentName ?></h4>
<p class="text-center" id="inv-descr">
    <?= $model->Profitability ?>%/<?= Yii::t('app', 'month') ?>
    <span class="px-2">|</span>
    <?= $model->Threshold ?> &ndash; <?= $model->getUpperThreshold() ?>
</p>

<p class="text-bg-warning p-2 d-flex align-items-center">
    <i class="bx bx-info-circle bx-sm pe-1"></i>
    <?= Yii::t('app', 'Accruals on Mondays. First accruals from 8 to 14 days.') ?>
</p>

<?php $form = ActiveForm::begin([
    // 'action' => 'invest-open',
    'method' => 'post',
    'options' => [
        'data-pjax' => 1,
    ],
]); ?>

    <?= $form->field($model, 'Id')->hiddenInput(['id' => 'inv-id'])->label(false) ?>

    <?= $form->field($model, 'Amount')->textInput(['placeholder' => Yii::t('app', 'Investment amount')])->label(false) ?>

    <div class="text-center">
        <?= Html::submitButton(Yii::t('app', 'Open investment'), ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

<p class="text-center fs-20 mt-3 mb-0" id="inv-balance"><?= number_format($model->getTotal(), 2, '.', ' ') ?> USDT</p>
<p class="text-muted text-center fs-24" id="inv-balance"><?= Yii::t('app', 'Total') ?></p>
<p class="text-center fs-20 mb-0" id="inv-balance"><?= number_format($model->balance, 2, '.', ' ') ?> USDT</p>
<p class="text-muted text-center mb-1" id="inv-balance"><?= Yii::t('app', 'Available balance') ?></p>
<p class="text-center fs-20 mt-1 mb-0" id="inv-balance"><?= number_format($model->refbalance, 2, '.', ' ') ?> USDT</p>
<p class="text-muted text-center" id="inv-balance"><?= Yii::t('app', 'Ref. balance') ?></p>

<?php Pjax::end() ?>

