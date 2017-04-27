<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Revenue */

$this->title = "Revenue ID: " . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Revenues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="revenue-view">

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
                    ['label'=>'Date', 'value'=>date('M d, Y', strtotime($model->date))],
                    ['label'=>'Student', 'value'=>$model->student?$model->student->formalName:'n/a'],
                    'payor',
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
                    <?= $form->field($revenueItem, 'account_id')->dropDownList($accountsList, ['prompt'=>'Select account title']) ?>
                </div>
                <div class="col-sm-5">
                    <?= $form->field($revenueItem, 'amount')->textInput(['maxWidth'=>true]) ?>
                </div>
                <div class="col-sm-2">
                <br />
                    <?= Html::submitButton('<i class="glyphicon glyphicon-plus"></i>',['class'=>'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Account Title</th>
                    <th>Amount</th>
                </tr>
                <?php foreach($model->revenueItems as $rItem) : ?>

                <tr>
                    <td><?= $rItem->account->title; ?></td>
                    <td style="text-align: right"><?= number_format($rItem->amount, 2) ?></td>
                </tr>

                <?php endforeach; ?>
                <tr>
                    <th>TOTAL</th>
                    <th style="text-align: right"><?= number_format($model->total, 2) ?></th>
                </tr>
            </table>
        </div>
    </div>
            

</div>
