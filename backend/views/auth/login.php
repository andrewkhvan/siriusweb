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
            <p class="mt-3 fs-15 fw-medium">Welcome Back! Sign in to continue.</p>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card mt-4 card-bg-fill">

            <div class="card-body p-4">
                <div class="text-center mt-2">
                    <h5 class="text-primary">Authorization</h5>
                    <p class="text-muted">Sign in to continue.</p>
                </div>
                <div class="p-2 mt-4">
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                    ]); ?>

                        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Enter email']) ?>

                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Enter password']) ?>

                        <?= $form->field($model, 'rememberMe')->checkbox([]) ?>

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
            <p class="mb-0">Don't have an account ? <a href="<?=Url::to(['auth/signup'])?>" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
        </div>

    </div>
</div>

<?php

$this->registerJsFile("/libs/particles.js/particles.js");
$this->registerJsFile("/js/pages/particles.app.js");
$this->registerJsFile("/js/pages/password-addon.init.js");
