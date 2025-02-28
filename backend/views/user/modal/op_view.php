<div class="row">
    <div class="col-4"><p class="fw-bold text-end">Date</p></div>
    <div class="col-8"><p><?= date('m/d/Y H:i:s', $data->Date) ?></p></div>
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
    <div class="col-8"><p><?= $data->PartnerName ?></p></div>
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
<button class="btn btn-soft-dark" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-success<?= $data->HasApproveButton ? '': ' disabled' ?>">Approve</button>
    <button type="button" class="btn btn-danger<?= $data->HasCancelButton ? '': ' disabled' ?>">Decline</button>
</div>
