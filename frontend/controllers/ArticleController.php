<?php

namespace frontend\controllers;

use yii\web\Controller;

class ArticleController extends Controller
{
    /**
     * @var string
     */
    public $layout = 'main';

    public function actionIndex()
    {
        return $this->render('index');
    }

//    public function
    
}
