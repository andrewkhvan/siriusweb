<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use backend\models\OperationForm;

?>
<div class="modal fade" id="modal-create" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span data-key="t-view-opcreate">Create Operation</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-4 col-lg-2',
                            'offset' => 'offset-sm-4 offset-lg-2',
                            'wrapper' => 'col-sm-8 col-lg-10',    
                        ],
                    ],
                ]) ?>

                    <?= $form->field($model, 'Operation')->dropdownList(OperationForm::getFilterList()) ?>

                    <?= $form->field($model, 'PartnerName')->textInput(['disabled' => true]) ?>

                    <?= $form->field($model, 'PartnerEmail')->textInput() ?>

                    <?= $form->field($model, 'Status')->textInput(['disabled' => true]) ?>

                    <?= $form->field($model, 'Investment')->dropdownList(OperationForm::getInvestmentList()) ?>

                    <?= $form->field($model, 'WAddress')->textInput() ?>

                    <?= $form->field($model, 'RefBalance')->checkBox() ?>

                    <?= $form->field($model, 'Virtual')->checkBox(['checked' => true]) ?>

                    <hr>

                    <div class="form-group offset-sm-4 offset-lg-2">
                        <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-primary']) ?>
                    </div>      
                        
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
