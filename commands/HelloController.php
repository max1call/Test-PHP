<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use app\models\BirthdayModel;
//use \app\controllers\SiteController;

use app\models\TimeForm;
/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
//    public static $birthDay;
//    public static $birthHour;
//    public $birthDay;
//    public $birthHour;
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
        return ExitCode::OK;
    }
    
    public function actionSend()
    {
	$birthModel = BirthdayModel::getInstance();
	$birthModel->sendEmail();	
    }/*
yii hello/send
     */   
  
}
