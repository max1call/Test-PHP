<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Workers */

$this->title = 'Создать сотрудника';
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создание';
?>
<div class="workers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
