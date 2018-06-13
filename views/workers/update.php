<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Workers */

$this->title = 'Корректировка сотрудника';
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Сотрудник', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Корректировка';
?>
<div class="workers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
