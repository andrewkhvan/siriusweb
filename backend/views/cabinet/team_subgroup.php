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
