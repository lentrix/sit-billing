<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Disbursement */

$this->title = 'Update Expense: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="disbursement-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'accountsList' => $accountsList,
    ]) ?>

</div>
