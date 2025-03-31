<?php

use yii\widgets\DetailView;

?>
<div class="card">
    <div class="card-body">

        <?= DetailView::widget([
            'model' => $data,
            'attributes' => [
                [
                    'label' => Yii::t('app', 'Amount of investment'),
                    'value' => $data->investment,
                ],
                [
                    'label' => Yii::t('app', 'Profit'),
                    'value' => $data->investBonus,
                ],
                [
                    'label' => Yii::t('app', 'Affiliate income'),
                    'value' => $data->directBonus,
                ],
                [
                    'label' => Yii::t('app', 'Total income'),
                    'value' => $data->totalBonus,
                ],
                [
                    'label' => Yii::t('app', 'SecondLevelInvestBonus'),
                    'value' => $data->secondLevelInvestBonus,
                ],
                [
                    'label' => Yii::t('app', 'Available balance'),
                    'value' => $data->balance,
                ],
                [
                    'label' => Yii::t('app', 'Weekly profitability'),
                    'value' => $data->getInvestBonusWeek() . ' USDT',
                ],
                [
                    'label' => Yii::t('app', 'Monthly profitability'),
                    'value' => $data->getInvestBonusMonth() . ' USDT',
                ],
                [
                    'label' => Yii::t('app', 'Annual profitability'),
                    'value' => $data->getInvestBonusYear() . ' USDT',
                ],
                [
                    'label' => Yii::t('app', 'Registration Date'),
                    'value' => $data->registrationDate,
                    'format' => 'date',
                ],
                [
                    'label' => Yii::t('app', 'Ref. balance'),
                    'value' => $data->refBalance . ' USDT',
                ],
                [
                    'label' => Yii::t('app', 'Top-up amount'),
                    'value' => $data->getCashInSum(),
                ],
                [
                    'label' => Yii::t('app', 'Amount of withdrawals'),
                    'value' => $data->getCashOutSum(),
                ],
                [
                    'label' => Yii::t('app', 'Waiting for withdrawal'),
                    'value' => $data->getCashAwait(),
                ],
            ]
        ]) ?>

    </div>
</div>
