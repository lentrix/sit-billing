<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Disbursement */

$this->title = 'Record Expense
';
$this->params['breadcrumbs'][] = ['label' => 'Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'accountsList' => $accountsList,
    ]) ?>

</div>
