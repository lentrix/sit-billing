<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Expense */

$this->title = 'Record Expense';
$this->params['breadcrumbs'][] = ['label' => 'Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-5">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'expenseItem' => $expenseItem,
        'accountsList' => $accountsList,
    ]) ?>

</div>
