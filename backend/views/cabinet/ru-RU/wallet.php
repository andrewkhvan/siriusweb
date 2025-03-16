<?php
/** @var yii\web\View $this */

$this->title = Yii::t('app', 'Wallet');
$this->params['breadcrumbs'][] = $this->title;

?>

<h4>Управление балансом</h4>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-lg-6 border-end mb-4">
                <h5 class="rounded bg-success-subtle p-2">Пополнение баланса</h5>
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=<?= $data->WAddress ?>" alt="">
                    </div>
                    <div class="ms-3">
                        <h4 class="mb-0">
                            <img class="avatar-xxs" src="/images/svg/crypto-icons/usdt.svg" alt="USDT">
                            <?= $data->Balance ?> USDT
                        </h4>
                        <p>Доступный баланс</p>
                        <p>Реф. баланс: <span class="badge bg-success"><?= number_format($data->RefBalance, 2, '.', ' ') ?> USDT</span></p>
                        <hr>
                        <p class="bg-warning-subtle text-warning-emphasis rounded p-2">Для пополнения вашего баланса, пожалуйста, используйте указанный ниже адрес. Обратите внимание, что перед совершением транзакции необходимо тщательно проверить корректность адреса.</p>
                    </div>
                </div>
                <div>
                    <h5 class="text-muted text-center fs-3 fw-semibold">Tether TRC-20</h5>
                    <p class="rounded p-1 bg-success-subtle text-center">
                        <a href="#" class="text-success-emphasis" id="copy-waddress" data-copy-text="<?= $data->WAddress ?>">
                            <i class="mdi mdi-content-copy"></i> <?= $data->WAddress ?>
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <h5 class="rounded bg-danger-subtle p-2">Вывод средств</h5>
                <p class="text-bg-light p-2">Для вывода средств со своего счета, пожалуйста, укажите адрес вашего кошелька USDT (TRC-20). Внимательно проверьте корректность указанного адреса и укажите желаемую сумму для снятия.</p>

            <?= $this->render('wallet_form', ['model' => $model]) ?>
            </div>
        </div>
    </div>
</div>
<?php

$js = <<< JS

$('#copy-waddress').click(function (e) {
    e.preventDefault();
    navigator.clipboard.writeText( $(this).attr('data-copy-text') );
    alert("Скопировано в буфер");

});

JS;

$this->registerJs($js);