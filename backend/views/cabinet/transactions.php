<?php
/** @var yii\web\View $this */

use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Transactions');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="card">
    <div class="card-body">

<?php Pjax::begin(['timeout' => 4000]); ?>

    <div class="d-flex">
        <div class="flex-grow-1">
            <?= $pager = LinkPager::widget([
                'pagination' => $pages,
                'maxButtonCount' => 5,
                'pageCssClass' => 'page-item',
                'linkOptions' => ['class' => 'page-link'],
                'disabledPageCssClass' => 'disabled page-link',
            ]) ?>
        </div>
        <div class="flex-shrink-0 mb-2">
            <?= $this->render('_search') ?>
        </div>
    </div>

    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}",
        'columns' => [
            [
                'attribute' => 'Date',
                'format' => 'datetime',
                'label' => Yii::t('app', 'Date'),
            ],
            [
                'attribute' => 'Operation',
                'label' => Yii::t('app', 'Operation'),
            ],
            [
                'attribute' => 'Bonus',
                'label' => Yii::t('app', 'Bonus'),
            ],
            [
                'attribute' => 'Sum',
                'format' => 'integer',
                'label' => Yii::t('app', 'Sum'),
            ],
            [
                'attribute' => 'Status',
                'label' => Yii::t('app', 'Status'),
            ],
            [
                'attribute' => 'refPartner',
                'label' => Yii::t('app', 'Ref. Partner'),
            ],
        ],
    ]) ?>
    </div>

    <?= $pager ?>

<?php Pjax::end(); ?>

    </div>
</div>
