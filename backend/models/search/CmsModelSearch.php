<?php


namespace backend\models\search;

use common\modelsgii\CmsModel;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * 模型搜索
 * @package backend\models\search
 */
class CmsModelSearch extends CmsModel
{

    public function rules()
    {
        return [
            [['name', 'category_tpl', 'content_tpl', 'create_time', 'update_time'], 'string', 'max' => 50],
            [['name', 'category_tpl', 'content_tpl', 'create_time', 'update_time'], 'safe']
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CmsModel::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'name' => $this->name,
            'category_tpl' => $this->category_tpl,
            'content_tpl' => $this->content_tpl,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        /*排序*/
        $query->orderBy([
            'sort' => SORT_ASC,
            'id' => SORT_DESC,
        ]);

        return $dataProvider;
    }
}