<?php

use yii\helpers\Url;

?>
<div class="row">
    <div class="col-4"><p class="fw-bold text-end">Date</p></div>
    <div class="col-8"><p><?= date('M d, Y H:i:s', $data->Date) ?></p></div>
</div>
<div class="row">
    <div class="col-4"><p class="fw-bold text-end">Number</p></div>
    <div class="col-8"><p><?= $data->DocNo ?></p></div>
</div>
<div class="row">
    <div class="col-4"><p class="fw-bold text-end">Operation</p></div>
    <div class="col-8"><p><?= $data->Operation ?></p></div>
</div>
<div class="row">
    <div class="col-4"><p class="fw-bold text-end">Operation Status</p></div>
    <div class="col-8"><p><?= $data->OperationStatus ?></p></div>
</div>
<div class="row">
    <div class="col-4"><p class="fw-bold text-end">Sum</p></div>
    <div class="col-8"><p><?= $data->DocSum ?></p></div>
</div>
<div class="row">
    <div class="col-4"><p class="fw-bold text-end">Name</p></div>
    <div class="col-8">
        <p>
            <?= $data->PartnerName ?>
            <a href="<?= Url::to(['user/partner-detail', 'partnerId' => $data->PartnerId]) ?>" target="_blank"> <i class="mdi mdi-eye mdi-18px"></i></a>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-4"><p class="fw-bold text-end">Email</p></div>
    <div class="col-8"><p><?= $data->PartnerEmail ?></p></div>
</div>
<div class="row">
    <div class="col-4"><p class="fw-bold text-end">Investment</p></div>
    <div class="col-8">
        <p><?= $data->Investment ?></p>
    </div>
</div>
<div class="row">
    <div class="col-4"><p class="fw-bold text-end">RefBalance</p></div>
    <div class="col-8">
        <p><i class="mdi mdi-18px mdi-checkbox-<?= $data->RefBalance ? 'marked':'blank' ?>-outline"></i></p>
    </div>
</div>
<div class="row">
    <div class="col-4"><p class="fw-bold text-end">Virtual</p></div>
    <div class="col-8"><p><i class="mdi mdi-18px mdi-checkbox-<?= $data->Virtual ? 'marked':'blank' ?>-outline"></i></p></div>
</div>
<div class="row">
    <div class="col-4"><p class="fw-bold text-end">Wallet</p></div>
    <div class="col-8"><p><?= $data->WAddress ?></p></div>
</div>

<div class="pt-2 text-end">
    <a href="<?= Url::to(['user/operation-update', 'docno' => $data->DocNo, 'status' => 'manual']) ?>" data-method="post" class="btn btn-primary<?= $data->HasApproveButton ? '': ' disabled' ?>">Manual Confirmation</a>
    <a href="<?= Url::to(['user/operation-update', 'docno' => $data->DocNo, 'status' => 'approve']) ?>" data-method="post" class="btn btn-success<?= $data->HasApproveButton ? '': ' disabled' ?>">Approve</a>
    <a href="<?= Url::to(['user/operation-update', 'docno' => $data->DocNo, 'status' => 'cancel']) ?>"  data-method="post" class="btn btn-danger<?= $data->HasCancelButton ? '': ' disabled' ?>">Decline</a>
    <button class="btn btn-soft-dark ms-2" data-bs-dismiss="modal">Close</button>
</div>
