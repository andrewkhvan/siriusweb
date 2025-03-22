<?php
/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = Yii::t('app', 'Wallet');
$this->params['breadcrumbs'][] = $this->title;

?>

<h4>Balance management</h4>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-lg-6 border-end mb-4">
                <h5 class="rounded bg-success-subtle p-2">Top up your balance</h5>
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <?= ($data->QR) ? Html::img($data->QR):'' ?>
                    </div>
                    <div class="ms-3">
                        <h4 class="mb-0">
                            <img class="avatar-xxs" src="/images/svg/crypto-icons/usdt.svg" alt="USDT">
                            <?= $data->Balance ?> USDT
                        </h4>
                        <p>Available balance</p>
                        <p>Ref. balance: <span class="text-bg-success py-1 px-2 rounded"><?= number_format($data->RefBalance, 2, '.', ' ') ?> USDT</span></p>
                        <?php if ($data->CashAwait): ?>
                            <p class="text-danger">Waiting for withdrawal</p>
                        <?php endif; ?>
                        <hr>
                        <p class="bg-warning-subtle text-warning-emphasis rounded p-2">To top up your balance, please use the address below. Please note that before making a transaction, you must carefully check the correctness of the address.</p>
                    </div>
                </div>
                <div>
                    <h5 class="text-muted text-center fs-3 fw-semibold">Tether TRC-20</h5>
                    <p class="rounded p-1 bg-success-subtle text-center">
                    <?php if ($data->WAddressIn): ?>
                        <a href="#" class="text-success-emphasis" id="copy-waddress" data-copy-text="<?= $data->WAddressIn ?>">
                            <i class="mdi mdi-content-copy"></i> <?= $data->WAddressIn ?>
                        </a>
                    <?php else: ?>
                        <i class="text-success">(not set)</i>
                    <?php endif; ?>
                    </p>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <h5 class="rounded bg-danger-subtle p-2">Withdrawal of funds</h5>
                <p class="text-bg-light p-2">To withdraw funds from your account, please provide your USDT wallet address (TRC-20). Carefully check the correctness of the specified address and indicate the desired amount for withdrawal.</p>

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
    alert("Copied to clipboard");

});

JS;

$this->registerJs($js);