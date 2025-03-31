<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception*/

use yii\helpers\Html;

$this->title = $name;
?>
<div class="row">
    <div class="col-lg-12">

<div class="text-center pt-4">

    <div class="mt-2">
        <img class="error-basic-img move-animation" src="/images/svg/error.svg" alt="">
    </div>
    <h1 class="display-1 fw-medium"><?= Html::encode($this->title) ?></h1>

    <h3 class="text-uppercase">
        <?= nl2br(Html::encode($message)) ?>
    </h3>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>
    <a href="/" class="btn btn-success"><i class="mdi mdi-home me-1"></i>Back to home</a>
</div>

    </div>
</div>
