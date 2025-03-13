<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Operations');

?>
<div class="card">
    <div class="card-body">
        <?php Pjax::begin(); ?>

        <div class="d-flex">
            <div class="flex-grow-1">
            <?= $linkPager = LinkPager::widget([
                'pagination' => $pages,
                'maxButtonCount' => 5,
                'pageCssClass' => 'page-item',
                'linkOptions' => ['class' => 'page-link'],
                'disabledPageCssClass' => 'disabled page-link',
            ]) ?>
            </div>
            <div class="flex-shrink-0">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create"><?= Yii::t('app', 'New operation') ?></button>
            </div>
            <div class="flex-shrink-0 ms-2">
                <?= $this->render('_search'); ?>
            </div>
        </div>

        <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}",
            'columns' => [
                'Date:datetime',
                [
                    'attribute' => 'DocNo',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a($model->DocNo, '#', [
                            'class'=>'text-primary',
                            'data' => [
                                'bs-toggle' => 'modal',
                                'bs-target' => '#modal-view',
                                'bs-optitle' => $model->DocNo,
                            ],
                        ]); 
                    },
                ],
                'Status',
                'Operation',
                'DocSum',
                // 'PartnerId',
                'PartnerName',
                'PartnerEmail',
                'Investment',
                'RefBalance:boolean',
                'Virtual:boolean',
                'WAddress',
            ],
        ]) ?>
        </div>

        <?= $linkPager ?>

        <?php Pjax::end(); ?>
    </div>
</div>

<div class="modal fade" id="modal-view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span data-key="t-view-op">Operation</span> <span id="op-num"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="op-body">
                <div class="text-center my-5 py-5"><i class="mdi mdi-loading mdi-spin mdi-36px"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body-pjax">
            <?php Pjax::begin(['options' => ['id' => 'p-1'],]) ?>
                <p class="text-center fs-1 my-4"><i class="bx bx-loader bx-spin"></i></p>
            <?php Pjax::end() ?>
            </div>
        </div>
    </div>
</div>


<?php

$this->registerJsFile('@web/js/operations.js', ['depends' => \yii\web\JqueryAsset::class]);
