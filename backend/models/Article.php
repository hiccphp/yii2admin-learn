<?php

namespace backend\models;

use Yii;

/*
 * ---------------------------------------
 * 文章模型
 * ---------------------------------------
 */

class Article extends \common\modelsgii\Article
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            /**
             * 写库和更新库时，时间自动完成
             * 注意rules验证必填时可使用AttributeBehavior行为，model的EVENT_BEFORE_VALIDATE事件
             */
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
                'value' => time(),
            ],
        ];
    }

    /**
     * ---------------------------------------
     * 获取一条数据
     * @param $id
     * @return array|bool|null|\yii\db\ActiveRecord
     * ---------------------------------------
     */
    public static function getContent($id)
    {
        if (empty($id)) {
            return false;
        }
        return static::find()->where(['id' => $id])->asArray()->one();
    }

}
