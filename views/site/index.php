<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'SIT | Billing System - Home';
?>

<div class="col-md-8 col-md-offset-2">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 style="text-align: center">Main Menu</h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-6">
                <?= Html::a("Record Revenue", ['/revenue/create'],['class'=>'btn btn-primary btn-block btn-lg']); ?>
                <br />
                <?= Html::a("Accounts", ['/account/index'],['class'=>'btn btn-primary btn-block btn-lg']); ?>
            </div>

            <div class="col-sm-6">
                <?= Html::a("Record Expense", ['/expense/create'],['class'=>'btn btn-primary btn-block btn-lg']); ?>
                <br />
                <?= Html::a("Students", ['/student/index'],['class'=>'btn btn-primary btn-block btn-lg']); ?>
            </div>
        </div>
    </div>

</div>