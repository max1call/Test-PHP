<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
//use app\commands\HelloController;
use app\models\BirthdayModel;

use app\models\TimeForm;

class SiteController extends Controller
{
//    public $day;
//    public $hour;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAdjust()
    {
	$timeForm = TimeForm::findOne(1);
	$bm = BirthdayModel::getInstance();

	if ($timeForm->load(Yii::$app->request->post())) {
	    //$this->sendMe();
	    $bm->sendEmail();
	    if($timeForm->save()){
		Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
		return $this->refresh();		
	    } else {
		Yii::$app->session->setFlash('error', 'Не удается сохранить данные');
	    }
        } 	
        return $this->render('adjust', ['timeForm' => $timeForm]);
    }
    
    public function sendMe(){
	Yii::$app->mailer->compose()
	    ->setFrom('max@sib12sib.ru')
	    ->setTo('max.maslov@mail.ru')
	    ->setSubject('Поздравляю!')	   
	    ->setHtmlBody("<b>Уважаемый Maxim, поздравляем тебя с наступающим днем рождения!</b>")
	    ->send();
    }
}
