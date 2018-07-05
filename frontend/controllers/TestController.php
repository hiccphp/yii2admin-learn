<?php


namespace frontend\controllers;


use yii\web\Controller;

class TestController extends Controller
{
    public $layout = 'main1';

    public function actionI18n()
    {
        return $this->render('lang');
        $lang = \Yii::$app->getRequest()->get('lang');
        if(isset($lang)) {
            \Yii::$app->session['language'] = $lang;
        }
        $this->goBack(\Yii::$app->request->headers['Referer']);
    }
}