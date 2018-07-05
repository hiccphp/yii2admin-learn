<?php
/**
 * create by PhpStorm.
 * User: Song
 * Date: 2018/6/14
 * Time: 16:16
 */

namespace common\modelsgii;

use Yii;

/**
 * This is the model class for table "yii2_cms_model".
 *
 * @property int $id
 * @property string $name 模型名称
 * @property string $category_tpl 分类页模型
 * @property string $content_tpl 内容页模板
 * @property string $create_time 创建时间
 * @property string $update_time 修改时间
 * @property string $ext_fields 扩展字段
 */
class CmsModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yii2_cms_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_tpl', 'content_tpl'], 'required'],
            [['name', 'category_tpl', 'content_tpl'], 'string', 'max' => 255],
            [['create_time', 'update_time', 'ext_fields'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_tpl' => 'Category Tpl',
            'content_tpl' => 'Content Tpl',
            'create_time' => 'create Time',
            'update_time' => 'update Time',
            'ext_fields' => 'Ext Fields',
        ];
    }
}