<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Receipt */

$this->title = "Revenue ID: " . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Revenue', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receipt-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <span class="pull-right">
            <?= Html::a('Record New Revenue', ['create'], ['class' => 'btn btn-primary']) ?>
        </span>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date',
            ['label'=>'Account Title', 'value'=>$model->account->title],
            ['label'=>'Student', 'value'=> $model->student ? $model->student->casualName : 'n/a' ],
            'amount',
            'remarks',
            'user.username',
        ],
    ]) ?>

</div>
