<?php


namespace common\helpers;


use common\modelsgii\Article;
use common\modelsgii\ArticleCat;
use yii\helpers\Url;
use yii\data\Pagination;

class CmsHelper
{
    /**
     * ---------------------------------------
     * 根据ID查找栏目
     * @param null $id
     * @return array|null|\yii\db\ActiveRecord[]
     * ---------------------------------------
     */
    public static function term($id = null)
    {
        if (isset($id)) {
            $term = ArticleCat::find()->where(['id' => $id])->asArray()->all();
            $newUrl = Url::to(['site/term', 'id' => $id]);
            $term['link'] = !empty($term['link']) ? $term['link'] : $newUrl;
            return $term;
        }
        return null;
    }

    /**
     * ---------------------------------------
     * 递归查找子栏目
     * @param null $id
     * @return array|null
     * ---------------------------------------
     */
    public static function termList($id = null)
    {
        $result = ArticleCat::find()
            ->where(['pid' => $id])->andWhere(['status' => 1])->orderBy('sort desc')->asArray()->all();
        if ($result) {
            foreach ($result as $item) {
                $item['child'] = self::termList($item['id']);
                $arr[] = $item;
            }
            return $arr;
        }
        return null;
    }

    /**
     * ---------------------------------------
     * 带分页的栏目查找
     * @param $id
     * @param int $pageSize
     * @return mixed
     * ---------------------------------------
     */
    public static function termListPage($id, $pageSize = 10)
    {
        $query = ArticleCat::find()->where(['pid' => $id])->andWhere(['status' => 1])->orderBy('sort desc,created desc');
        $count = $query->count();
        $page = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $data = $query->offset($page->offset)
            ->limit($page->limit)
            ->asArray()
            ->all();
        foreach ($data as $key => $t) {
            $data[$key]['link'] = !empty($t['link']) ? $t['link'] : Url::to(['/site/term', 'id' => $t['id']]);
            $data[$key]['img'] = !empty($t['cover_img']) ? json_decode($t['cover_img'], true)['newname'] : '';
        }
        $termPage['page'] = $page;
        $termPage['data'] = $data;
        return $termPage;
    }
}