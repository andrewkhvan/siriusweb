<?php
/** @var yii\web\View $this */

$this->title = 'Deposits';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php foreach ($data->rows as $row): ?>
    <div class="card">
        <div class="card-body">
            <h4><?= $row->InvestmentName ?></h4>
            <p>Profitability <?= $row->Profitability ?>%</p>
            <p><?= date('m/d/Y', $row->OpenDate) ?></p>
            <p>Profit <?= $row->Profit ?></p>
            <p>Charges <?= $row->Charges ?></p>
        </div>
    </div>
<?php endforeach; ?>