<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Revenue */

$this->title = 'Record Revenue';
$this->params['breadcrumbs'][] = ['label' => 'Revenues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row col-md-6">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->widget(
        DatePicker::className(), [
            'inline' => false, 
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
    ]);?>

    <?= $form->field($model, 'student_id')->dropDownList($studentsList, ['prompt'=>'Select student']) ?>

    <?= $form->field($model, 'payor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($revenueItem, 'account_id')->dropDownList($accountsList, ['prompt'=>'Account title']) ?>

    <?= $form->field($revenueItem, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
