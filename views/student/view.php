<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Student;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = $model->casualName;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-view">

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
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'lname',
            'fname',
            'mname',
            'address',
            'phone',
            ['label'=>'Level', 'value'=>Student::$_levels[$model->level]],
        ],
    ]) ?>

</div>
