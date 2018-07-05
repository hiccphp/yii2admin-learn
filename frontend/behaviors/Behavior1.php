<?php

namespace frontend\behaviors;

use yii\base\Behavior;

class Behavior1 extends Behavior
{
//    protected $height; //会报错
    public $height;

    public function eat()
    {
        echo 'dog eat ^_^ ^_^!<br/>';
    }

    public function events()
    {
        return [
            'wang'=>'shout',
        ];
    }

    public function shout($event)
    {
        echo 'wang wang wang <br/>';
    }
}
