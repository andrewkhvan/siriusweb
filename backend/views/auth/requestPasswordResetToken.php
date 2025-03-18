<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\PasswordResetRequestForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = Yii::t('auth', 'Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="text-center mt-sm-5 mb-4">
            <div>
                <h3 class="d-inline-block text-white-50"><?= Yii::$app->name ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-6">
        <div class="card mt-4 card-bg-fill">
            <div class="card-body p-4">

    <div class="text-center mt-2 mb-4">
        <h5 class="text-primary"><?= Html::encode($this->title) ?></h5>
    </div>

    <p><?= Yii::t('auth', 'Please fill out your email. A link to reset password will be sent there.') ?></p>

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{beginWrapper}{input}{hint}{error}{endWrapper}'
        ],
    ]); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('email')]) ?>

        <div class="form-group">
            <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
