<?php
//use app;

//use app\models\BirthdayModel;

//$model = BirthdayModel::getInstance();
//var_dump($model);
//send('fox@sib12sib.ru', 'Ivan');
$name = 'Ivan';
$sendTo = 'fox@sib12sib.ru';
//function send($sendTo, $name){
    Yii::$app->mailer->compose()
 ->setFrom('DJ@sib12sib.ru')
 ->setTo($sendTo)
 ->setSubject('Поздравляю!')
 ->setTextBody("Уважаемый $name, поздравляем тебя с наступающим днем рождения!")
 ->setHtmlBody("<b>Уважаемый $name, поздравляем тебя с наступающим днем рождения!</b>")
 ->send();
//}