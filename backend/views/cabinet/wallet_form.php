<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;
use backend\models\wallet\CashoutForm;

$btn = <<< BTN
<a href="#" class="btn btn-soft-dark" data-bs-toggle="modal" data-bs-target="#modal-wallet">Change</a>
BTN;
?>
<?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'wAddress', [
        'template' => "{label}\n<div class=\"input-group\">{input}$btn</div>\n{hint}\n{error}"
    ])
        ->textInput(['placeholder' => $model->getAttributeLabel('wAddress'), 'readonly' => true, 'class' => 'form-control bg-dark-subtle']) ?>

    <?= $form->field($model, 'amount')->textInput(['placeholder' => $model->getAttributeLabel('amount')]) ?>

    <?= $form->field($model, 'refBalance')->dropDownList(CashoutForm::getBalanceList()) ?>

    <div class="form-group"><?= Html::submitButton(Yii::t('app', 'Withdraw funds'), ['class' => 'btn btn-success']) ?></div>
<?php ActiveForm::end() ?>

<div class="modal fade" id="modal-wallet" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <?php Pjax::begin() ?>
                <?php Pjax::end() ?>
            </div>
        </div>
    </div>
</div>

<?php

$this->registerJsFile('@web/js/wallet.js', ['depends' => \yii\web\JqueryAsset::class]);
