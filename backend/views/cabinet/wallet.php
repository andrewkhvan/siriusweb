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
                    <div class="flex-shrink-0 ms-3">
                        <h4 class="mb-0">
                            <img class="avatar-xxs" src="/images/svg/crypto-icons/usdt.svg" alt="USDT">
                            <?= $data->Balance ?> USDT
                        </h4>
                        <p>Доступный баланс</p>
                        <p>Реф. баланс: <span class="badge bg-success"><?= number_format($data->RefBalance, 2, '.', ' ') ?> USDT</span></p>
                    </div>
                </div>
                <hr>
                <div>
                    <h5 class="text-muted text-center fs-3 fw-semibold">Tether TRC-20</h5>
                    <p class="rounded p-1 bg-success text-success bg-opacity-10 text-center"><?= $data->WAddress ?></p>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <h5 class="rounded bg-danger-subtle p-2">Вывод средств</h5>
                <p class="bg-warning bg-opacity-10 p-2">Для вывода средств со своего счета, пожалуйста, укажите адрес вашего кошелька USDT (TRC-20). Внимательно проверьте корректность указанного адреса и укажите желаемую сумму для снятия.</p>
                <div class="mt-2">
                    <div class="input-group">
                        <span class="input-group-text"><i class="mdi mdi-map-marker"></i></span>
                        <input type="text" class="form-control" placeholder="Адрес получения">
                    </div>
                </div>
                <div class="mt-2">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bx bx-dollar"></i></span>
                        <input type="password" class="form-control" id="placeholderInput" placeholder="Сумма вывода">
                    </div>
                </div>
                <div class="mt-2">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bx bx-link"></i></span>
                        <select class="form-select" id="inputGroupSelect01">
                            <option value="1" selected>Реферальный баланс</option>
                            <option value="2">Основной баланс</option>
                        </select>
                    </div>
                </div>
                <div class="mt-2"><button class="btn btn-success">Вывести средства</button></div>
            </div>
        </div>
    </div>
</div>
