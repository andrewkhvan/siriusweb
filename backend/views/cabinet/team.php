<?php
/** @var yii\web\View $this */

$this->title = 'Affiliate team ';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-sm-12 col-lg-4">
        <!-- card -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium">Affiliate activity</p>
                    </div>
                </div>
                <div class="text-center">
                    <p><img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=https://sirius-energy.co/?ref=<?= Yii::$app->user->identity->email ?>" alt=""></p>
                    <a href="#" data-copy-text="https://sirius-energy.co/?ref=<?= Yii::$app->user->identity->email ?>" class="text-muted">
                        <i class="mdi mdi-content-copy"></i>
                        <small>https://sirius-energy.co/?ref=<?= Yii::$app->user->identity->email ?></small>
                    </a>
                </div>
                <hr>
                <h4>Statistics</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex my-2">
                            <div class="flex-grow-1"><div class="fw-semibold">Total partners</div><small></small></div>
                            <div class="flex-shrink-0 text-succes ms-2s"><?= $info->totalCount ?></div>
                        </div>
                        <div class="d-flex my-2">
                            <div class="flex-grow-1"><div class="fw-semibold">Active partners</div><small></small></div>
                            <div class="flex-shrink-0 text-succes ms-2s"><?= $info->activeCount ?></div>
                        </div>
                        <div class="d-flex my-2">
                            <div class="flex-grow-1"><div class="fw-semibold">Personal partners</div><small></small></div>
                            <div class="flex-shrink-0 text-succes ms-2s"><?= $info->refCount ?></div>
                        </div>
                        <div class="d-flex my-2">
                            <div class="flex-grow-1"><div class="fw-semibold">Partner turnover</div><small>General investments</small></div>
                            <div class="flex-shrink-0 text-success ms-2">$<?= $info->getTotalStructInvestment() ?></div>
                        </div>
                        <div class="d-flex my-2">
                            <div class="flex-grow-1"><div class="fw-semibold">Transitions</div><small>According to ref. link</small></div>
                            <div class="flex-shrink-0 text-succes ms-2s"><?= $info->refCount ?></div>
                        </div>
                    </div>
                </div>

            </div><!-- end card body -->
        </div><!-- end card -->

        <div class="card">
            <div class="card-header"><h5 class="card-title">Ranking system</h5></div>
            <div class="card-body">
                <div class="d-flex mb-2">
                    <div class="flex-grow-1">Account Status</div>
                    <div class="flex-shrink-0 fw-semibold ms-2"><?= $info->rankTitle ?></div>
                </div>
                <div class="d-flex mb-2">
                    <div class="flex-grow-1">Income by level</div>
                    <div class="flex-shrink-0 fw-semibold ms-2">3% &ndash; 3%</div>
                </div>
                <div class="d-flex mb-2">
                    <div class="flex-grow-1">Prize received</div>
                    <div class="flex-shrink-0 fw-semibold ms-2"><?= $info->rankBonus ?></div>
                </div>
                <div class="d-flex mb-2">
                    <div class="flex-grow-1">Turnover to next rank</div>
                    <div class="flex-shrink-0 fw-semibold ms-2"><?= $info->turnoverToNextRank ?></div>
                </div>
                <div class="d-flex mb-2">
                    <div class="flex-grow-1">Deposit up to next rank</div>
                    <div class="flex-shrink-0 fw-semibold ms-2"><?= $info->depositUpToNextRank ?></div>
                </div>
            </div>
        </div>

    </div><!-- end col -->

    <div class="col-sm-12 col-lg-8">
        <!-- card -->
        <div class="card">
            <div class="card-body" id="team-group">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <p class="text-uppercase fw-medium mb-0">Partners table</p>
                    </div>
                </div>
                <div class="list-group nested-list">
                    <?php foreach ($data->rows as $member): ?>
                    <div class="list-group-item pe-1">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <i class="mdi mdi-account-circle mdi-36px text-secondary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-14"><?= $member->Name ?></h5>
                                <p class="text-muted mb-0">Rank-<?= $member->Rank ?></p>
                            </div>
                            <?php if ($member->HasChildren): ?>
                            <div class="flex-shrink-0">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#children-<?= $member->PartnerId?>" data-id="<?= $member->PartnerId ?>" class="toggle-subgroup">
                                    <i class="mdi mdi-plus-box-outline mdi-24px"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php if ($member->HasChildren): ?>
                        <div class="collapse" id="children-<?= $member->PartnerId?>"></div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

</div> <!-- end row-->

<?php

$this->registerJsFile('@web/js/team.js', ['depends' => [\yii\web\JqueryAsset::class]]);