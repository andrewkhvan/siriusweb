<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use backend\models\Lang;
use yii\helpers\Url;

AppAsset::register($this);
$partner = Yii::$app->user->identity ?? null;

if ($partner && !$partner->paid) {
    $this->beginPage();
    ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="/favicon.png" type="image/x-icon">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | <?= Yii::$app->name ?></title>
        <?php $this->head() ?>
        <style>
            body {
                background: url('/images/solar_bg.jpg') center center / cover no-repeat;
                min-height: 100vh;
            }
        </style>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div class="modal fade" id="abonentka-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <p><?= nl2br(Yii::t('app', 'Account verification notice')) ?></p>
                    <?php if ($partner->wAddressIn): ?>
                        <p class="rounded p-1 bg-success-subtle text-center">
                            <a href="#" class="text-success-emphasis" id="copy-waddress-modal" data-copy-text="<?= $partner->wAddressIn ?>">
                                <i class="mdi mdi-content-copy"></i> <?= $partner->wAddressIn ?>
                            </a>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="modal-footer justify-content-between">
                    <div>
                        <?= Html::beginForm(['/auth/logout'], 'post') ?>
                            <button type="submit" class="btn btn-secondary"><?= Yii::t('app', 'Logout') ?></button>
                        <?= Html::endForm() ?>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= Lang::getFlag(Yii::$app->language) ?>" alt="<?= Yii::$app->language ?>" height="20" class="rounded">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php foreach (Lang::getList() as $code => $label): ?>
                                <li>
                                    <a href="<?= Url::base() ?>?lang=<?= $code ?>" class="dropdown-item" title="<?= $label ?>">
                                        <img src="<?= Lang::getFlag($code) ?>" alt="<?= $label ?>" class="me-2 rounded" height="18">
                                        <span class="align-middle"><?= $label ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $js = <<<JS
var abModal = new bootstrap.Modal(document.getElementById('abonentka-modal'), {backdrop: 'static', keyboard: false});
abModal.show();
var copyBtn = document.getElementById('copy-waddress-modal');
if (copyBtn) {
    copyBtn.addEventListener('click', function(e){
        e.preventDefault();
        navigator.clipboard.writeText(this.getAttribute('data-copy-text'));
        alert('Copied to clipboard');
    });
}
JS;
    $this->registerJs($js);
    ?>
    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage(); return; }

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" data-theme="modern" data-layout="vertical">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/favicon.png" type="image/x-icon">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | <?= Yii::$app->name ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column">
<?php $this->beginBody() ?>
<div id="layout-wrapper">
    <?= $this->render('topbar') ?>
    <?= $this->render('sidebar') ?>

    <main role="main" class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0"><?= $this->title ?></h4>

                            <div class="page-title-right">
                            <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                'options' => ['class' => 'm-0'],
                            ]) ?>
                            </div>

                        </div>
                    </div>
                </div>

                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <?= date('Y') ?> © Sirius Energy.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block"></div>
                    </div>
                </div>
            </div>
        </footer>
    </main>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
