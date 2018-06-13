<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\TimeForm;

class BirthdayModel extends Model{
    
    protected $birthDay;
    protected $birthHour;
    
    protected static $_instance;
    private function __construct() {}
    
    public static function getInstance() {
	if (self::$_instance === null) {
	    self::$_instance = new self;
	}
	return self::$_instance;
    }

    public static function tableName() {
	return 'workers';
    }
    
    public function getBirthBoy($dateBirth){
	$sql = "SELECT name, email FROM workers WHERE
		birth LIKE '%".$dateBirth."'";	
	return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public function updateTime(){
	$timeForm = TimeForm::findOne(1);
	$d = $timeForm->day;
	$h = $timeForm->hour;
		
	$t = (time() + ($d * 24 + $h) * 60 * 60);

	 return $t;
    }
    
    public function sendEmail()
    {

	$nextTime = $this->updateTime();

	$birthBoy = $this->getBirthBoy(date('m-d', $nextTime));
	
	foreach ($birthBoy as $boy){
	    if (isset($boy['email']) && isset($boy['name'])) {
		$name = $boy['name'];
		$email = $boy['email'];
		Yii::$app->mailer->compose()
		    ->setFrom('max@sib12sib.ru')
		    ->setTo($email)
		    ->setSubject('Поздравляю!')
		    ->setTextBody("Уважаемый $name, поздравляем тебя с наступающим днем рождения!")
		    ->setHtmlBody("<b>Уважаемый $name, поздравляем тебя с наступающим днем рождения!</b>")
		    ->send();  
	    }
	}
    }

}
