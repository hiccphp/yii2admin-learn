<?php


namespace frontend\controllers;


use yii\web\Controller;

class LearnController extends Controller
{
    /**
     * @var string
     */
    public $layout = 'main1';

    public function actionWidget()
    {
        return $this->render('widget');
    }
}