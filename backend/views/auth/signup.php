<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use backend\models\SignupForm;

$this->title = 'Sign Up';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="col-lg-12">
        <div class="text-center mt-sm-5 mb-4 text-white-50">
            <div>
                <a href="/" class="d-inline-block auth-logo">
                    <img src="/images/logo-light.png" alt="" height="20">
                </a>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card mt-4 card-bg-fill">

            <div class="card-body p-4">
                <div class="text-center mt-2">
                    <h5 class="text-primary">Create New Account</h5>
                </div>
                <div class="p-2 mt-4">
                    <?php $form = ActiveForm::begin([
                        'id' => 'signup-form',
                        'fieldConfig' => [
                            'template' => "{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}"
                        ],
                    ]); ?>

                        <?= $form->field($model, 'name')->textInput(['placeholder' => $model->getAttributeLabel('name')]) ?>

                        <?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

                        <?= $form->field($model, 'password_repeat')->passwordInput(['placeholder' => $model->getAttributeLabel('password_repeat')]) ?>

                        <?= $form->field($model, 'country')->textInput(['placeholder' => $model->getAttributeLabel('country')]) ?>

                        <?= $form->field($model, 'countryCode')->textInput(['placeholder' => $model->getAttributeLabel('countryCode')]) ?>

                        <?= $form->field($model, 'city')->textInput(['placeholder' => $model->getAttributeLabel('city')]) ?>

                        <?= $form->field($model, 'phone')->textInput(['placeholder' => $model->getAttributeLabel('phone')]) ?>

                        <?= $form->field($model, 'sponsorEmail')->textInput(['placeholder' => $model->getAttributeLabel('sponsorEmail')]) ?>

                        <?= $form->field($model, 'language')->dropDownList(SignupForm::getLangList()) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Sign In', ['class' => 'btn btn-success w-100', 'name' => 'login-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->

        <div class="mt-4 text-center">
            <p class="mb-0">Already have an account ? <a href="<?=Url::to(['auth/login'])?>" class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
        </div>

    </div>
</div>

<?php

$this->registerJsFile("/libs/particles.js/particles.js");
$this->registerJsFile("/js/pages/particles.app.js");
$this->registerJsFile("/js/pages/password-addon.init.js");
