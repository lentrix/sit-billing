<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Expense */

$this->title = "Expense # " . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expense-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-6">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'date',
                    'payee',
                    'remarks',
                    'user.username',
                ],
            ]) ?>
        </div>
        <div class="col-md-6">
            <h3>Particulars</h3>

            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-sm-5">
                    <?= $form->field($expenseItem, 'account_id')->dropDownList($accountsList,['prompt'=>'Account title']) ?>
                </div>
                <div class="col-sm-5">
                    <?= $form->field($expenseItem, 'amount')->textInput() ?>
                </div>
                <div class="col-sm-2">
                    <br />
                    <?= Html::submitButton('<i class="glyphicon glyphicon-plus"></i>',['class'=>'btn btn-primary']); ?>
                </div>
            </div>
            <div>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Account Title</th>
                        <th>Amount</th>
                    </tr>
                    <?php $total = 0; ?>
                    <?php foreach($model->expenseItems as $eItem) : ?>
                    <tr>
                        <td><?= $eItem->account->title ?></td>
                        <td style="text-align: right"><?= number_format($eItem->amount, 2) ?></td>
                    </tr>
                        <?php $total += $eItem->amount; ?>
                    <?php endforeach; ?>
                    <tr>
                        <th>TOTAL</th>
                        <th style="text-align: right"><?= number_format($total, 2) ?></th>
                    </tr>
                </table>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
