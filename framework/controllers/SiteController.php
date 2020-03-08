<?php

namespace app\controllers;

use app\models\Contact;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
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
        $model =  new Contact();
        $this->layout = 'contactform';

        $problem = "";
        if ($model->load(Yii::$app->request->post())){
            if($model->save()){
                //We need send the email with the info


                $mail = new \PHPMailer();
                $mail->IsSMTP();
                $mail->Port = 587;
                $mail->Host = "mail.miskosas.com";
                $mail->Username = "info@miskosas.com";
                $mail->Password = "lastinfo123!";
                $mail->SetFrom("info@miskosas.com", "Info");
                $mail->AddAddress("info@miskosas.com");
                $mail->Subject = 'Contact form miskosas';
                $mail->Body = '<b>Contact info</b><br><p>Email:'.$model->email.'<br>Name:'.$model->name.'<br>Phone:'.$model->phone.'<br>Message:'.$model->message.'<br></p><p>This info has been stored.</p>';
                if($mail->Send()){
                    $model->sent = 1;
                    $model->save();
                } else {
                    print_r("Error!");
                }
                // info@miskosas.com  lastinfo123!
                return $this->render('contactok', [
                ]);
            } else {
                // server-side or backend validation
                $problem .= "Exist a problem saving the info, please check and try again.";
                return $this->render('contact', [
                    'model' => $model,
                    'problem' => $problem,
                ]);
            }
        } else {
            return $this->render('contact', [
                'model' => $model,
                'problem' => $problem,
            ]);
            //$problem .= "The form is not complete or is a new request.";
        }


    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
