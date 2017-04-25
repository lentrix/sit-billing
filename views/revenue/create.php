<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Receipt */

$this->title = 'Record Revenue';
$this->params['breadcrumbs'][] = ['label' => 'Revenue', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receipt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'accountsList' => $accountsList,
        'studentsList' => $studentsList
    ]) ?>

</div>
