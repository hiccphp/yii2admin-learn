<?php

namespace frontend\controllers;

use frontend\behaviors\Behavior1;
use vendor\animal\Dog;
use yii\web\Controller;
use vendor\animal\Mourse;
use vendor\animal\Cat;
use yii\base\Event;

class EventController extends Controller
{
    public $layout = 'main1';

    public function actionIndex()
    {
        \Yii::$app->on(\yii\base\Application::EVENT_AFTER_REQUEST, function(){
           echo 'event after request !!<br/>';
        });//请求处理之后触发
        echo 'hello index action<br/>';//请求时触发

//        $cat = new Cat();
//        $mourse = new Mourse();
//        $dog = new Dog();
//        $cat2 = new Cat();

//        Event::on(Cat::className(), 'miao', [$mourse, 'run']); //猫出现事件绑定所有的老鼠对象中的方法

//        Event::on(Cat::className(), 'miao', function(){
//            echo 'miao event has ben triggered!<br/>';
//        }); //猫出现事件绑定所有的匿名方法

//        $cat->on('miao', [$mourse, 'run']); //将猫出现事件绑定到老鼠的run方法绑定
//        $cat->on('miao', [$dog, 'look']); //将猫出现事件绑定到狗的look方法绑定
//        $cat->off('miao', [$dog, 'look']); //将猫出现事件绑定到狗的look方法解绑

//        $cat->shout();
//        $cat2->shout(); //没有任何绑定
    }

    public function actionMixi()
    {
        $dog = new Dog();
//        $dog->look();
//        $dog->eat();
//        $dog->height = "15cm";
//        echo $dog->height;

        $dog->trigger('wang');
    }

    public function actionObjMixi()
    {
        $dog = new Dog();
        $behavior1 = new Behavior1();
        $dog->attachBehavior('beh1', $behavior1);
//        $dog->detachBehavior('beh1', $behavior1); //解绑
        $dog->eat();
    }
}