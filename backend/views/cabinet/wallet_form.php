<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use backend\models\wallet\CashoutForm;


?>
<?php $form = ActiveForm::begin([
    'fieldConfig' => [
        'template' => "{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
    ]
]) ?>
    <?= $form->field($model, 'wAddress')->textInput(['placeholder' => $model->getAttributeLabel('wAddress')]) ?>

    <?= $form->field($model, 'amount')->textInput(['placeholder' => $model->getAttributeLabel('amount')]) ?>

    <?= $form->field($model, 'refBalance')->dropDownList(CashoutForm::getBalanceList()) ?>

    <div class="form-group"><?= Html::submitButton(Yii::t('app', 'Withdraw funds'), ['class' => 'btn btn-success']) ?></div>
<?php ActiveForm::end() ?>
