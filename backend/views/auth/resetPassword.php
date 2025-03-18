<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ResetPasswordForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Reset password';
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


<div class="site-reset-password">
    <div class="text-center mt-2 mb-4">
        <h5 class="text-primary"><?= Html::encode($this->title) ?></h5>
    </div>

    <p><?= Yii::t('auth', 'Please choose your new password:') ?></p>

    <div class="row">
        <div class="col">
            <?php $form = ActiveForm::begin([
                'id' => 'reset-password-form',
            ]); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>
</div>
