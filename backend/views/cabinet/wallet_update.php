<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap5\ActiveForm;

?>
<?php Pjax::begin() ?>
    <?php $form = ActiveForm::begin([
        'options' => [
            'data-pjax' => 1,
        ],
    ]) ?>

        <?= $form->field($model, 'newwaddress')->textInput() ?>

        <?= $form->field($model, 'pin')->textInput(['placeholder' => Yii::t('app', 'Enter PIN code from email') ]) ?>

        <div class="button-group">
            <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end() ?>
<?php Pjax::end() ?>
