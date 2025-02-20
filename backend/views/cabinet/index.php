<?php
/** @var yii\web\View $this */

$this->title = Yii::t('app', 'Cabinet');
$this->params['breadcumbs'][] = $this->title;

?>
<h4>Personal account</h4>

<div class="row">
    <div class="col-xl-12">
        <div class="card crm-widget">
            <div class="card-body p-0">
                <div class="row row-cols-md-3 row-cols-1">
                    <div class="col col-lg border-end">
                        <div class="py-4 px-3">
                            <h6 class="text-muted text-uppercase fs-11">Amount of investment</h6>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-space-ship-line display-6 text-muted"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h3 class="mb-0">$<span class="counter-value" data-target="<?= $data->Investment ?>">0</span></h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col col-lg border-end">
                        <div class="mt-3 mt-md-0 py-4 px-3">
                            <h6 class="text-muted text-uppercase fs-11">Profit</h6>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-exchange-dollar-line display-6 text-muted"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h3 class="mb-0">$<span class="counter-value" data-target="489.4">0</span></h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col col-lg border-end">
                        <div class="mt-3 mt-md-0 py-4 px-3">
                            <h6 class="text-muted text-uppercase fs-13">Affiliate income</h6>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-pulse-line display-6 text-muted"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h3 class="mb-0">$<span class="counter-value" data-target="32.89">0</span></h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col col-lg">
                        <div class="mt-3 mt-lg-0 py-4 px-3">
                            <h6 class="text-muted text-uppercase fs-13">Total income</h6>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-trophy-line display-6 text-muted"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h3 class="mb-0">$<span class="counter-value" data-target="1596.5">0</span></h3>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-sm-12 col-lg-6">
        
        <div class="card">
            <div class="card-header"><h4  class="card-title">Account statistics</h4></div>
            <div class="card-body">&nbsp;</div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-header"><h4  class="card-title">Investment statistics</h4></div>
            <div class="card-body">&nbsp;</div>
        </div>
    </div>
</div>



