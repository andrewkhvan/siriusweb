<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>

<?php if (count($model->errors)): ?>
    <?php foreach ($model->errors as $error): ?>
        <div class="alert alert-danger" role="alert"><?= $error ?></div>
    <?php endforeach; ?>
<?php endif; ?>

<div class="card">
    <div class="card-header"><h4 class="card-title">Settings</h4></div>

    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'errorCssClass' => '',
        'successCssClass' => '',
        'validatingCssClass' => '',
    ]) ?>
    <div class="card-body">
        <div class="form-switch form-switch-danger">
            <?= $form->field($model, 'BalanceWithdrawalBlocked')->checkbox(); ?>
        </div>

        <div class="form-switch form-switch-danger">
            <?= $form->field($model, 'RefBalanceWithdrawalBlocked')->checkbox(); ?>
        </div>
        
        <div class="form-switch form-switch-danger">
            <?= $form->field($model, 'AccountBlocked')->checkbox(); ?>
        </div>

    </div>

    <div class="card-footer">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>