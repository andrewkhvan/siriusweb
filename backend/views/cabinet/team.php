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

        <?= $this->render('_ranking_system', ['data' => $info]); ?>

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