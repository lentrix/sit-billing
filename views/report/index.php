<?php
use yii\helpers\Html;

$this->title = "SIT | Billing - Reports";

?>
<h1>Reports</h1>
<div class="row">
    <div class="col-md-4">

        <?= Html::a('Cash Flow', ['/report/cash-flow'], 
            ['class'=>'btn btn-default btn-lg btn-block']) ?>

        <?= Html::a('Income Statement', ['/report/income-statement'], 
            ['class'=>'btn btn-default btn-lg btn-block']) ?>

    </div>
</div>