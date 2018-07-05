<?php
/**
 * Created by PhpStorm.
 * User: Song
 * Date: 2018/6/14
 * Time: 16:22
 */

namespace backend\models;


class CmsModel extends \common\modelsgii\CmsModel
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
}