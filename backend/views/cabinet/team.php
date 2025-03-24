<?php
/** @var yii\web\View $this */

use backend\models\User;

$this->title = Yii::t('app', 'Affiliate team');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-sm-12 col-lg-3">
        <!-- card -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium"><?= Yii::t('app', 'Affiliate activity') ?></p>
                    </div>
                </div>
                <div class="text-center">
                    <p><img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=<?= User::getRefLink() ?>" alt=""></p>
                    <a href="#" id="ref-link" data-copy-text="<?= User::getRefLink() ?>" class="text-muted">
                        <i class="mdi mdi-content-copy"></i>
                        <small><?= User::getRawRefLink() ?></small>
                    </a>
                </div>
                <hr>
                <h4><?= Yii::t('app', 'Statistics') ?></h4>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex my-2">
                            <div class="flex-grow-1"><div class="fw-semibold"><?= Yii::t('app', 'Total partners') ?></div><small></small></div>
                            <div class="flex-shrink-0 text-succes ms-2s"><?= $info->totalCount ?></div>
                        </div>
                        <div class="d-flex my-2">
                            <div class="flex-grow-1"><div class="fw-semibold"><?= Yii::t('app', 'Active partners') ?></div><small></small></div>
                            <div class="flex-shrink-0 text-succes ms-2s"><?= $info->activeCount ?></div>
                        </div>
                        <div class="d-flex my-2">
                            <div class="flex-grow-1"><div class="fw-semibold"><?= Yii::t('app', 'Personal partners') ?></div><small></small></div>
                            <div class="flex-shrink-0 text-succes ms-2s"><?= $info->refCount ?></div>
                        </div>
                        <div class="d-flex my-2">
                            <div class="flex-grow-1"><div class="fw-semibold"><?= Yii::t('app', 'Partner turnover') ?></div><small><?= Yii::t('app', 'General investments') ?></small></div>
                            <div class="flex-shrink-0 text-success ms-2">$<?= $info->getTotalStructInvestment() ?></div>
                        </div>
                        <div class="d-flex my-2">
                            <div class="flex-grow-1"><div class="fw-semibold"><?= Yii::t('app', 'Transitions') ?></div><small><?= Yii::t('app', 'According to ref. link') ?></small></div>
                            <div class="flex-shrink-0 text-succes ms-2s"><?= $info->refCount ?></div>
                        </div>
                    </div>
                </div>

            </div><!-- end card body -->
        </div><!-- end card -->

        <div class="card">
            <div class="card-header"><h5 class="card-title"><?= Yii::t('app', 'Ranking system') ?></h5></div>
            <div class="card-body">
                <div class="d-flex mb-2">
                    <div class="flex-grow-1"><?= Yii::t('app', 'Account Status') ?></div>
                    <div class="flex-shrink-0 fw-semibold ms-2"><?= $info->rankTitle ?></div>
                </div>
                <div class="d-flex mb-2">
                    <div class="flex-grow-1"><?= Yii::t('app', 'Income by level') ?></div>
                    <div class="flex-shrink-0 fw-semibold ms-2">3% &ndash; 3%</div>
                </div>
                <div class="d-flex mb-2">
                    <div class="flex-grow-1"><?= Yii::t('app', 'Prize received') ?></div>
                    <div class="flex-shrink-0 fw-semibold ms-2"><?= $info->rankBonus ?></div>
                </div>
                <div class="d-flex mb-2">
                    <div class="flex-grow-1"><?= Yii::t('app', 'Turnover to next rank') ?></div>
                    <div class="flex-shrink-0 fw-semibold ms-2"><?= $info->turnoverToNextRank ?></div>
                </div>
                <div class="d-flex mb-2">
                    <div class="flex-grow-1"><?= Yii::t('app', 'Deposit up to next rank') ?></div>
                    <div class="flex-shrink-0 fw-semibold ms-2"><?= $info->depositUpToNextRank ?></div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success"
                        role="progressbar"
                        style="width: <?= $info->depositProgressValue ?>%;"
                        aria-valuenow="<?= $info->investment ?>"
                        aria-valuemin="0"
                        aria-valuemax="<?= $info->depositUpToNextRank ?>"><?= $info->depositProgressValue ?>%</div>
                </div>
            </div>
        </div>

    </div><!-- end col -->

    <div class="col-sm-12 col-lg-9">
        <!-- card -->
        <div class="card">
            <div class="card-body" id="team-group">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium mb-0"><?= Yii::t('app', 'Partners table') ?></p>
                    </div>
                </div>
                <div class="list-group nested-list">
                    <?= $this->render('team_subgroup', ['data' => $data]) ?>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

</div> <!-- end row-->

<?php

$this->registerJsFile('@web/js/team.js', ['depends' => [\yii\web\JqueryAsset::class]]);