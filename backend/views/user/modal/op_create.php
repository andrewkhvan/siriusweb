<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use backend\models\Operation;
use yii\widgets\Pjax;
use yii\widgets\Menu;

?>
<?php Pjax::begin([
    'options' => ['id' => 'p-1'],
]) ?>
<div class="modal-body">

<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 mb-4 d-inline-block position-relative w-100" style="box-shadow:none">
    <div class="dropdown-head bg-secondary pt-2 px-2">
        <div class="row align-items-center p-3">
            <div class="col"><h4 class="text-white"><?= Yii::t('app', 'Create Operation') ?></h4></div>
            <div class="col-auto">
                <button class="btn btn-sm btn-light" data-bs-dismiss="modal">
                    <i class="mdi mdi-close"></i>
                </button>
            </div>
        </div>
    <?= Menu::widget([
        'options' => ['class' => 'nav nav-tabs dropdown-tabs nav-tabs-custom'],
        'linkTemplate' => '<a href="{url}" class="nav-link" data-pjax="1">{label}</a>',
        'items' => [
            ['label' => 'Replenishment', 'url' => ['user/operation-create', 'task' => 'cashin'], 'options' => ['class' => 'nav-item']],
            ['label' => 'Withdrawal', 'url' => ['user/operation-create', 'task' => 'cashout'], 'options' => ['class' => 'nav-item']],
            ['label' => 'Investment', 'url' => ['user/operation-create', 'task' => 'investment'], 'options' => ['class' => 'nav-item']],
        ],
    ]); ?>
    </div>
</div>

<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'method' => 'post',
    'options' => [
        'class' => 'p-2',
        'data-pjax' => 1,
    ],
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-sm-4 col-lg-2',
            'offset' => 'offset-sm-4 offset-lg-2',
            'wrapper' => 'col-sm-8 col-lg-10',    
        ],
    ],
]) ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?php if (in_array('investmentId', $scenario)): ?>
        <?= $form->field($model, 'investmentId')->dropdownList(Operation::getInvestmentList()) ?>
    <?php endif; ?>

    <?php if (in_array('wAddress', $scenario)): ?>
        <?= $form->field($model, 'wAddress')->textInput() ?>
    <?php endif; ?>

    <?php if (in_array('amount', $scenario)): ?>
        <?= $form->field($model, 'amount')->textInput() ?>
    <?php endif; ?>

    <?php if (in_array('refBalance', $scenario)): ?>
        <?= $form->field($model, 'refBalance')->checkBox() ?>
    <?php endif; ?>

    <?php if (in_array('virtual', $scenario)): ?>
        <?= $form->field($model, 'virtual')->checkBox(['checked' => true]) ?>
    <?php endif; ?>

    <?php if (in_array('status', $scenario)): ?>
        <?= $form->field($model, 'status')->textInput(['disabled' => true]) ?>
    <?php endif; ?>

    <hr>

    <div class="form-group offset-sm-4 offset-lg-2">
        <?= Html::submitButton(Yii::t('app', 'Add operation'), ['class' => 'btn btn-primary']) ?>
    </div>      
        
<?php ActiveForm::end(); ?>

</div>
<?php Pjax::end() ?>
