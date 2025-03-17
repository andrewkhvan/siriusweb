<?php foreach ($data->rows as $member): ?>
<div class="list-group-item pe-1">
    <div class="d-flex">
        <div class="flex-shrink-0 me-3">
            <i class="mdi mdi-account-circle mdi-36px text-secondary"></i>
        </div>
        <div class="flex-grow-1">
            <h5 class="fs-14"><?= $member->Name ?> <span class="text-muted ps-2">Rank-<?= $member->Rank ?></span></h5>
            <div class="text-muted mb-2"><?= date('M d, Y', $member->RegistrationDate) ?></div>
            <p><?= Yii::t('app', 'Invested') ?> <?= number_format($member->InvestmentValue, 2, '.', ' ') ?></p>
        </div>
        <div class="flex-shrink-0 ms-2 text-end">
            <div class="mb-2 text-muted fs-10"><small><?= Yii::t('app', 'Level {0}', [$member->Level]) ?></small></div>
        <?php if ($member->HasChildren): ?>
            <a href="#" data-bs-toggle="collapse" data-bs-target="#children-<?= $member->PartnerId?>" data-id="<?= $member->PartnerId ?>" class="toggle-subgroup">
                <i class="mdi mdi-plus-box-outline mdi-24px"></i>
            </a>
        <?php endif; ?>
        </div>
    </div>
<?php if ($member->HasChildren): ?>
    <div class="collapse" id="children-<?= $member->PartnerId?>">
        <h5 class="text-center text-muted"><?= Yii::t('app', 'Loading...') ?></h5>
        <h4 class="my-4 text-center"><i class="bx bx-loader bx-spin"></i></h4>
    </div>
<?php endif; ?>
</div>
<?php endforeach; ?>
