<?php
/** @var yii\web\View $this */

use yii\widgets\Pjax;

$this->title = 'Investment directions';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
<?php foreach ($data->rows as $item): ?>
    <div class="col-xs-12 col-lg-6 col-xxl-4">
        <div class="card ">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-end fw-medium text-muted mb-0"><?= $item->InvestmentName ?></p>
                    </div>
                </div>
                <div class="align-items-end justify-content-between mt-4">
                    <h4 class="fs-22 fw-semibold ff-secondary"><?= $item->Profitability ?>%</h4>
                    <p class="text-muted mb-4"><i class="bx bx-time"></i> <?= Yii::t('app', 'Investment period - unlimited') ?></p>

                    <div class="bg-success-subtle rounded p-2" id="threshold-<?= $item->Id ?>">
                        <img class="avatar-xs" src="/images/svg/crypto-icons/usdt.svg">
                        <?= number_format($item->Threshold, 2, ',', ' ')  ?>
                        &ndash;
                    <?php if ($item->UpperThreshold != 0): ?>
                        <?= number_format($item->UpperThreshold, 2, '.', ' ') ?> USDT
                    <?php else: ?>
                        <?= Yii::t('app', 'unlimited amount') ?>
                    <?php endif ?>
                    </div>

                    <?php /*<div class=""><?= $item->Remainder ?></div>*/ ?>
                </div>
                <hr class="text-muted">
                <div class="align-items-center">
                    <a href="#" class="btn btn-success d-block modal-invest-button" data-bs-toggle="modal" data-bs-target="#modal-invest" data-inv-id="<?= $item->Id ?>"><?= Yii::t('app', 'Open an investment') ?></a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

<div class="modal fade" id="modal-invest" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <?php Pjax::begin() ?>
                    <p class="text-center my-4">&nbsp;</p>
                <?php Pjax::end() ?>
            </div>
        </div>
    </div>
</div>

<?php

$this->registerJsFile('@web/js/investments.js', ['depends' => \yii\web\JqueryAsset::class]);
