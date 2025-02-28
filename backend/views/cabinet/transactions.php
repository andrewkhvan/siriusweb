<?php
/** @var yii\web\View $this */

use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\grid\GridView;

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="card">
    <div class="card-body">

<?php Pjax::begin(); ?>

    <div class="d-flex">
        <div class="flex-grow-1">
            <?= $pager = LinkPager::widget([
                'pagination' => $pages,
                'pageCssClass' => 'page-item',
                'linkOptions' => ['class' => 'page-link'],
                'disabledPageCssClass' => 'disabled page-link',
            ]) ?>
        </div>
        <div class="flex-shrink-0 mb-2">
            <?= $this->render('_search') ?>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}",
        'columns' => [
            'Date:datetime',
            'Operation',
            'Bonus',
            'Sum:integer',
            'refPartner',
        ],
    ]) ?>

    <?= $pager ?>

<?php Pjax::end(); ?>

    </div>
</div>
