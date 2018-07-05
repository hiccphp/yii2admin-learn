<?php


namespace backend\controllers;

use backend\models\CmsModel;
use common\helpers\FuncHelper;
use Yii;
use backend\models\search\CmsModelSearch;
use yii\web\NotFoundHttpException;

/**
 * UI文件模型控制器
 * @package backend\controllers
 */
class CmsModelController extends BaseController
{
    /**
     * ---------------------------------------
     * 模型列表页
     * ---------------------------------------
     */
    public function actionIndex()
    {
        /* 添加当前位置到cookie供后续跳转调用 */
        $this->setForward();
        $searchModel = new CmsModelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = $this->findModel(0);
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('CmsModel');
            /*格式化扩展字段ext_fields的值*/
            if ($data['ext_fields']) {
                $tmp = FuncHelper::parse_field_attr($data['ext_fields']);
                if (is_array($tmp)) {
                    $data['ext_fields'] = serialize($tmp);
                } else {
                    $data['ext_fields'] = '';
                }
            }
            /* 表单数据加载、验证、数据库操作 */
            if ($this->saveRow($model, $data)) {
                $this->success('操作成功', $this->getForward());
            } else {
                $this->error('操作错误');
            }
        }
        /*获取模型默认数据*/
        $model->loadDefaultValues();
        /*渲染模板*/
        return $this->render('edit', [
            'model' => $model,
        ]);

    }

    public function actionEdit()
    {
        $id = Yii::$app->request->get('id', 0);
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('CmsModel');
            if ($data['ext_fields']) {
                $tmp = FuncHelper::parse_field_attr($data['ext_fields']);
                if (is_array($tmp)) {
                    $data['ext_fields'] = serialize($tmp);
                } else {
                    $data['ext_fields'] = '';
                }
            }
            /* 表单数据加载、验证、数据库操作 */
            if ($this->saveRow($model, $data)) {
                $this->success('操作成功', $this->getForward());
            } else {
                $this->error('操作错误');
            }
        }
        /*还原extend的数据*/
        if ($model->ext_fields) {
            $_tmp = unserialize($model->ext_fields);
            $_str = '';
            if ($_tmp && is_array($_tmp)) {
                foreach ($_tmp as $key => $value) {
                    $_str .= $key . ':' . $value . ',';
                }
            }
            $model->ext_fields = $_str;
        }
        /*渲染模板*/
        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    /**
     * ---------------------------------------
     * 删除或批量删除
     * @return string
     * @throws NotFoundHttpException
     * ---------------------------------------
     */
    public function actionDelete()
    {
        $model = $this->findModel(0);
        if ($this->delRow($model, 'id')) {
            $this->success('删除成功', $this->getForward());
        } else {
            $this->error('删除失败！');
        }
    }

    public function findModel($id)
    {
        if ($id == 0) {
            return new CmsModel();
        }
        if (($model = CmsModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}