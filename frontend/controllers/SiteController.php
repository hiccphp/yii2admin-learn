<?php


namespace frontend\controllers;


use backend\models\Article;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * @var string
     */
    public $layout = 'main1';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTerm()
    {
        return 'term page';
    }

    public function actionContent($id = null)
    {
        $content = Article::getContent($id);
        $contentList = Article::find()->where(['category_id' => $content['category_id']])->andWhere(['status' => 1])->orderBy('create_time desc, id desc')->asArray()->all();
        foreach ($contentList as $item) {

        }

        return $this->render('content.php');
    }

    public function actionTest()
    {
        echo \Yii::t('app', '<h1>This is a string to translate</h1><br/>');

        \Yii::$app->language = 'zh-TW';
        echo \Yii::t('common', 'Login');
    }

    public function actionI18n()
    {

    }
}