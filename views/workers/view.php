<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Workers */

$this->title = 'Сотрудник';
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Точно удаляем?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'surname',
            'function',
            'phone',
            'email:email',
            'birth',
//            'img_src',
//            'img_src:image',
	    [
		'label' => 'Картинка',
		'format' => 'raw',
		'value' => function($data){
//		    return Html::img(Url::toRoute($data->category_image),[
		    return Html::img(Url::to('@web/uploads/'.$data->img_src),[
			
			'alt'=>'yii2 - картинка в gridview',
			'style' => 'width:100px;'
		    ]);
		},
	    ],
        ],
    ]) ?>

</div>
