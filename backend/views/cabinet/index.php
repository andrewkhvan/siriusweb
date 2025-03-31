<?php
/** @var yii\web\View $this */

use yii\helpers\Url;
use backend\models\User;

$this->title = Yii::t('app', 'Cabinet');
$this->params['breadcumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-sm-12 col-xl-9 col-xxl-10">

<h4><?= Yii::t('app', 'Personal account') ?></h4>
<div class="row">
    <div class="col-xl-12">
        <div class="card crm-widget">
            <div class="card-body p-0">
                <div class="row row-cols-md-3 row-cols-1">
                    <div class="col col-lg border-end">
                        <div class="py-4 px-3">
                            <h6 class="text-muted text-uppercase fs-11"><?= Yii::t('app', 'Amount of investment') ?></h6>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-space-ship-line display-6 text-muted"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h3 class="mb-0">$<span class="counter-value" data-target="<?= $data->investment ?>">0</span></h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col col-lg border-end">
                        <div class="mt-3 mt-md-0 py-4 px-3">
                            <h6 class="text-muted text-uppercase fs-11"><?= Yii::t('app', 'Profit') ?></h6>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-exchange-dollar-line display-6 text-muted"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h3 class="mb-0">$<span class="counter-value" data-target="<?= $data->investBonus ?>">0</span></h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col col-lg border-end">
                        <div class="mt-3 mt-md-0 py-4 px-3">
                            <h6 class="text-muted text-uppercase fs-13"><?= Yii::t('app', 'Affiliate income') ?></h6>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-pulse-line display-6 text-muted"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h3 class="mb-0">$<span class="counter-value" data-target="<?= $data->directBonus ?>">0</span></h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col col-lg">
                        <div class="mt-3 mt-lg-0 py-4 px-3">
                            <h6 class="text-muted text-uppercase fs-13"><?= Yii::t('app', 'Total income') ?></h6>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-trophy-line display-6 text-muted"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h3 class="mb-0">$<span class="counter-value" data-target="<?= $data->totalBonus ?>">0</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-sm-12 col-lg-6">
        
        <div class="card">
            <div class="card-header"><h4  class="card-title"><?= Yii::t('app', 'Account statistics') ?></h4></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 border-end">
                        <h4 class="mb-5"><?= Yii::t('app', 'Available balance') ?></h4>
                        <h3 class="text-success">$<?= $data->balance ?></h3>
                        <div class="fs-6 text-success fw-semibold"><?= $data->refBalance ?> USDT <?= Yii::t('app', 'Ref. balance') ?></div>
                        <div class="text-center mt-5"><a href="<?= Url::to(['cabinet/wallet'])?>" class="btn btn-success d-block"><?= Yii::t('app', 'Top up balance') ?></a></div>
                    </div>
                    <div class="col-6">
                        <div class="">
                            <h5 class="fs-6 fw-medium"><?= Yii::t('app', 'Top-up amount') ?></h5>
                            <div class="mb-4 fw-semibold">$<?= $data->getCashInSum() ?></div>
                        </div>
                        <div class="">
                            <h5 class="fs-6 fw-medium"><?= Yii::t('app', 'Amount of withdrawals') ?></h5>
                            <div class="mb-4 fw-semibold">$<?= $data->getCashOutSum() ?></div>
                        </div>
                        <div class="">
                            <h5 class="fs-6 fw-medium"><?= Yii::t('app', 'Waiting for withdrawal') ?></h5>
                            <div class="mb-4 fw-semibold text-danger-emphasis">$<?= $data->getCashAwait() ?></div>
                        </div>
                        <div>
                            <h5 class="fs-6 fw-medium"><?= Yii::t('app', 'Main currency') ?></h5>
                            <div class="fw-semibold"><img class="avatar-xxs" src="/images/svg/crypto-icons/usdt.svg"> Tether (TRC-20)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-header"><h4  class="card-title"><?= Yii::t('app', 'Investment statistics') ?></h4></div>
            <div class="card-body">
                <div class="d-flex mb-4">
                    <div class="bg-success-subtle text-center w-50 p-2 rounded">
                        <img class="avatar-sm" src="/images/svg/crypto-icons/usdt.svg" alt="USDT">
                        <h4 class="fw-medium"><?= $data->investment ?> USDT</h4>
                        <small class="text-muted"><?= Yii::t('app', 'Total amount of deposits') ?></small>
                    </div>
                    <div class="ms-3">
                        <h5 class=""><?= $data->investBonus ?> USDT</h5>
                        <div class="text-muted"><?= Yii::t('app', 'Dividends received') ?></div>
                        <hr>
                        <div class="text-success fw-semibold">~ <?= $data->investBonusWeek ?> USDT</div>
                        <div class="text-muted"><?= Yii::t('app', 'Next accrual') ?></div>
                    </div>
                </div>

                <div class="mb-2"><?= Yii::t('app', 'Payback:') ?> <span class="fw-semibold"><?= $data->investBonus ?> of <?= $data->investment ?> USDT</span></div>
                <div class="progress progress-xl">
                    <div class="progress-bar bg-success"
                        role="progressbar"
                        style="width: <?= $data->progressValue ?>%;"
                        aria-valuenow="<?= $data->investBonus ?>"
                        aria-valuemin="0"
                        aria-valuemax="<?= $data->investment ?>"><?= $data->progressValue ?>%</div>
                </div>
                <div class="row mt-4">
                    <div class="col-4 text-center">
                        <h4 class="fw-semibold fs-6 text-success">~<?= $data->getInvestBonusWeek() ?> USDT</h4>
                        <small class="text-muted"><?= Yii::t('app', 'Weekly profitability') ?></small>
                    </div>
                    <div class="col-4 text-center">
                        <h4 class="fw-semibold fs-6 text-success">~<?= $data->getInvestBonusMonth() ?> USDT</h4>
                        <small class="text-muted"><?= Yii::t('app', 'Monthly profitability') ?></small>
                    </div>
                    <div class="col-4 text-center">
                        <h4 class="fw-semibold fs-6 text-success">~<?= $data->getInvestBonusYear() ?> USDT</h4>
                        <small class="text-muted"><?= Yii::t('app', 'Annual profitability') ?></small>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-sm-12">
        <div class="card card-height-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1"><?= Yii::t('app', 'Income growth') ?></h4>
            </div><!-- end card header -->
            <div class="card-body px-0">
                <div id="bonus-charts" data-colors='["--vz-success", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div><!-- end card -->
    </div><!-- end col -->

</div>

    </div><!-- end left col -->
    <div class="col-sm-12 col-xl-3 col-xxl-2">

<div class="row">
    <div class="col-sm-6 col-xl-12">
        <h4><?= Yii::t('app', 'Affiliate activity') ?></h4>
        <div class="bg-vertical-gradient-2 rounded p-4 text-center mb-4">
            <p><img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=<?= User::getRefLink() ?>" alt="" class="w-100" style="max-width:160px"></p>
            <a href="<?= User::getRefLink() ?>" data-copy-text="<?= User::getRefLink() ?>" class="text-light" id="ref-link">
                <i class="mdi mdi-content-copy"></i>
                <small><?= User::getRawRefLink() ?></small>
            </a>
        </div>

        <?= $this->render('_ranking_system', ['data' => $data]);  ?>
    </div>

    <div class="col-sm-6 col-xl-12">
        <?= $this->render('_info_statistics', ['data' => $data]) ?>
    </div>
</div>

    </div><!-- end right col -->

</div>
<?php

$this->registerCssFile('/libs/apexcharts/apexcharts.css');
$this->registerJsFile('/libs/apexcharts/apexcharts.min.js');
$this->registerJsFile('/js/cab_index.js', ['depends' => \yii\web\JqueryAsset::class]);
