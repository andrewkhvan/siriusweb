<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Login';
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
                        'id' => 'login-form',
                    ]); ?>

                        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Enter email'])->label(false) ?>

                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Enter password'])->label(false) ?>

                        <?= $form->field($model, 'password_repeat')->passwordInput(['placeholder' => 'Repeat password'])->label(false) ?>

                        <?= $form->field($model, 'country')->textInput(['placeholder' => 'Enter Country'])->label(false) ?>

                        <?= $form->field($model, 'city')->textInput(['placeholder' => 'Enter City'])->label(false) ?>

                        <?= $form->field($model, 'mentor_email')->textInput(['placeholder' => 'Mentor email'])->label(false) ?>

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
