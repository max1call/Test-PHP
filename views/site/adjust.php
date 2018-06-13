<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="row">
	
    <div class="col-lg-offset-4 col-lg-4">
	<h4 class="text-center">
	    <b>Напоминать о дне рождения за:</b>	    
	</h4>
	 
	<?php $form = ActiveForm::begin(); ?>
	<?= $form->field($timeForm, 'day') ?>
	<?= $form->field($timeForm, 'hour') ?>
	<div class="form-group text-center">
	    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
	    <?= '<br><br>Текущая дата: '.date('Y-m-d  H:i:s'); ?>
	</div>
	<?php ActiveForm::end(); ?>
	
    </div>
</div>
    

