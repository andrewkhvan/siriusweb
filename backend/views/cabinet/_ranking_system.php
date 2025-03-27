<div class="card">
    <div class="card-header"><h5 class="card-title"><?= Yii::t('app', 'Ranking system') ?></h5></div>
    <div class="card-body">
        <div class="d-flex mb-2">
            <div class="flex-grow-1"><?= Yii::t('app', 'Account Status') ?></div>
            <div class="flex-shrink-0 fw-semibold ms-2"><?= $data->rankTitle ?></div>
        </div>
        <div class="d-flex mb-2">
            <div class="flex-grow-1"><?= Yii::t('app', 'Income by level') ?></div>
            <div class="flex-shrink-0 fw-semibold ms-2">3% &ndash; 3%</div>
        </div>
        <div class="d-flex mb-2">
            <div class="flex-grow-1"><?= Yii::t('app', 'Prize received') ?></div>
            <div class="flex-shrink-0 fw-semibold ms-2"><?= $data->rankBonus ?></div>
        </div>

        <div class="d-flex mb-2">
            <div class="flex-grow-1"><?= Yii::t('app', 'Turnover to next rank') ?></div>
            <div class="flex-shrink-0 fw-semibold ms-2"><?= $data->turnoverToNextRank ?></div>
        </div>
        <div class="progress">
            <div class="progress-bar bg-info"
                role="progressbar"
                style="width: <?= $data->turnoverProgressValue ?>%;"
                aria-valuenow="<?= $data->totalStructInvestment ?>"
                aria-valuemin="0"
                aria-valuemax="<?= $data->turnoverToNextRank ?>"><?= $data->turnoverProgressValue ?>%</div>
        </div>

        <div class="d-flex mt-3 mb-2">
            <div class="flex-grow-1"><?= Yii::t('app', 'Deposit up to next rank') ?></div>
            <div class="flex-shrink-0 fw-semibold ms-2"><?= $data->depositUpToNextRank ?></div>
        </div>
        <div class="progress">
            <div class="progress-bar bg-success"
                role="progressbar"
                style="width: <?= $data->depositProgressValue ?>%;"
                aria-valuenow="<?= $data->investment ?>"
                aria-valuemin="0"
                aria-valuemax="<?= $data->depositUpToNextRank ?>"><?= $data->depositProgressValue ?>%</div>
        </div>
    </div>
</div>
