<?php
/** @var yii\web\View $this */

$this->title = 'Deposits';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php foreach ($data->rows as $row): ?>
    <div class="card">
        <div class="card-body row">
            <div class="col-md-4">
                <h4 class="text-success-emphasis"><?= $row->InvestmentName ?></h4>
                <h5><span class="fs-2"><?= $row->Profitability ?>%</span> <small class="text-muted">Monthly return</small></h5>
                <div class="my-2"><i class="mdi mdi-timelapse"></i> Investment period - unlimited</div>
                <div class="rounded pt-4 border-top">
                    <div class="bg-success-subtle text-success-emphasis fw-semibold p-2">
                        <img class="avatar-xxs" src="/images/svg/crypto-icons/usdt.svg" alt="USDT">
                        <?= number_format($row->Investment, 2, '.', ' ') ?> USDT
                    </div>
                    <p class="text-muted">Investment amount</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-muted">Opening date</div>
                <h5><?= date('m/d/Y', $row->OpenDate) ?></h5>
                <div class="text-muted">Accrual</div>
                <h5>Every Monday</h5>
                <div class="text-muted">Weekly profit</div>
                <h5><?= $row->Profitability / 4 ?>%</h5>
            </div>
            <div class="col-md-4 text-center">
                <div class="mb-2">
                    <div class="text-success-emphasis"><i class="las la-3x la-donate"></i></div>
                    <h4 class="text-success-emphasis"><?= number_format($row->Profit, 2, '.', ' ') ?> USDT</h4>
                    <div class="text-muted">Profits received</div>
                </div>
                <p>Charges: <?= $row->Charges ?></p>
                <p><a href="#" class="btn btn-soft-dark d-block">Download the contract</a></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>