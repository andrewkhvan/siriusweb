<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
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

<?php if (!Yii::$app->user->isGuest && !Yii::$app->user->identity->paid): ?>
    <?php
    $this->registerCss('.modal-backdrop.show{backdrop-filter:blur(5px);}');
    $js = <<<JS
    var paidModal = new bootstrap.Modal(document.getElementById('modal-paid'));
    paidModal.show();
    $('#copy-waddress').on('click', function (e) {
        e.preventDefault();
        navigator.clipboard.writeText($(this).data('copy-text'));
        alert('Copied to clipboard');
    });
JS;
    $this->registerJs($js);
    ?>
    <div class="modal fade" id="modal-paid" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Уважаемые партнёры!</p>
                    <p>Для корректной работы платформы и возможности проведения всех выплат и возвратов средств важно иметь точные и актуальные данные пользователей.</p>
                    <p>В связи с этим необходимо пройти процедуру верификации аккаунта. Она предусматривает оплату в размере 60 USDT на кошелек указанный тут, после чего ваш кабинет будет активирован, а система получит необходимые данные для корректной обработки выплат.</p>
                    <p>Эти средства направляются на поддержку стабильной работы сайта и идентификацию пользователей. Это позволит обеспечить защиту аккаунтов и сохранить их в актуальном состоянии.</p>
                    <p>Оплату необходимо произвести до 20 сентября. Данная процедура является обязательной и взимается ежегодно.</p>
                    <p class="text-center">
                        <a href="#" class="text-success-emphasis" id="copy-waddress" data-copy-text="<?= Yii::$app->user->identity->wAddressIn ?>">
                            <i class="mdi mdi-content-copy"></i> <?= Yii::$app->user->identity->wAddressIn ?>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
