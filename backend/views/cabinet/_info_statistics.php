<h4><?= Yii::t('app', 'Statistics') ?></h4>
<div class="card">
    <div class="card-body">
        <div class="d-flex my-2">
            <div class="flex-grow-1"><div class="fw-semibold"><?= Yii::t('app', 'Total partners') ?></div><small></small></div>
            <div class="flex-shrink-0 text-succes ms-2s"><?= $data->totalCount ?></div>
        </div>
        <div class="d-flex my-2">
            <div class="flex-grow-1"><div class="fw-semibold"><?= Yii::t('app', 'Active partners') ?></div><small></small></div>
            <div class="flex-shrink-0 text-succes ms-2s"><?= $data->activeCount ?></div>
        </div>
        <div class="d-flex my-2">
            <div class="flex-grow-1"><div class="fw-semibold"><?= Yii::t('app', 'Personal partners') ?></div><small></small></div>
            <div class="flex-shrink-0 text-succes ms-2s"><?= $data->refCount ?></div>
        </div>
        <div class="d-flex my-2">
            <div class="flex-grow-1"><div class="fw-semibold"><?= Yii::t('app', 'Partner turnover') ?></div><small><?= Yii::t('app', 'General investments') ?></small></div>
            <div class="flex-shrink-0 text-success ms-2">$<?= $data->getTotalStructInvestment() ?></div>
        </div>
        <div class="d-flex my-2">
            <div class="flex-grow-1"><div class="fw-semibold"><?= Yii::t('app', 'Transitions') ?></div><small><?= Yii::t('app', 'According to ref. link') ?></small></div>
            <div class="flex-shrink-0 text-succes ms-2s"><?= $data->refCount ?></div>
        </div>
    </div>
</div>
