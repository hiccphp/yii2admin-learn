<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\ArticleCat;

/* @var $model common\modelsgii\CmsModel */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \backend\models\search\CmsModelSearch */

//var_dump($searchModel);
//var_dump($dataProvider);
/* ===========================以下为本页配置信息================================= */
/* 页面基本属性 */
$this->title = '内容管理';
$this->params['title_sub'] = '';

/* 加载页面级别的资源 */
\backend\assets\TablesAsset::register($this);

$columns = [
    [
        'class' => \common\core\CheckboxColumn::className(),
        'name' => 'id',
        'options' => ['width' => '20px;'],
        'checkboxOptions' => function ($model, $key, $index, $column) {
            return ['value' => $key, 'label' => '<span></span>', 'labelOptions' => ['class' => 'mt-checkbox mt-checkbox-outline', 'style' => 'padding-left:19px;']];
        }
    ],
    [
        'header' => 'ID',
        'attribute' => 'id',
        'options' => ['width' => '50px;']
    ],
    [
        'header' => '名称',
        'attribute' => 'name',
    ],
    [
        'header' => '分类模型',
        'attribute' => 'category_tpl',
    ],
    [
        'header' => '内容模型',
        'attribute' => 'content_tpl',
    ],
    [
        'label' => '排序',
        'value' => 'sort',
        'options' => ['width' => '50px;'],
    ],
    [
        'class' => '\yii\grid\ActionColumn',
        'header' => '操作',
        'template' => '{edit}{delete}',
        'options' => ['width' => '200px;'],
        'buttons' => [
            'edit' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-edit"></i>', ['edit', 'id' => $model['id']], [
                    'title' => Yii::t('app', '编辑'),
                    'class' => 'btn btn-xs purple'
                ]);
            },
            'delete' => function ($url, $model, $key) {
                return Html::a('<li class="fa fa-times"></li>', $url, [
                    'class' => 'btn btn-xs red ajax-get confirm'
                ]);
            },
        ],
    ],
];

?>

    <div class="portlet light portlet-fit portlet-datatable bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-settings font-dark"></i>
                <span class="caption-subject font-dark sbold uppercase">管理模型</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided">
                    <?= Html::a('添加 <i class="fa fa-plus"></i>', ['create'], ['class' => 'btn green', 'style' => 'margin-right:10px;']) ?>
                    <?= Html::a('删除 <i class="fa fa-times"></i>', ['delete'], ['class' => 'btn green ajax-post confirm', 'target-form' => 'ids', 'style' => 'margin-right:10px;']) ?>
                </div>
                <div class="btn-group">
                    <button class="btn blue btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                        工具箱
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="javascript:;"><i class="fa fa-pencil"></i> 导出Excel </a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:;"> 其他 </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="portlet-body">
            <?php \yii\widgets\Pjax::begin(['options' => ['id' => 'pjax-container']]); ?>
            <div>
                <?= $this->render('_search', ['model' => $searchModel]); ?>
            </div>
            <div class="table-container">
                <form class="ids">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider, //列表模型
                        'options' => ['class' => 'grid-view table-scrollable'],
                        /* 表格配置 */
                        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer'],
                        /*重新排版、摘要、表格、分页*/
                        'layout' => '{items}<div class=""><div class="col-md-5 col-sm-5">{summary}</div><div class="col-md-7"><div class="dataTables_paginate paging_bootstrap_full_number" style="text-align: right;">{pager}</div></div></div>',
                        /*配置摘要*/
                        'pager' => [
                            'options' => ['class' => 'pagination', 'style' => 'visibility: visible;'],
                            'nextPageLabel' => '下一页',
                            'prevPageLabel' => '上一页',
                            'firstPageLabel' => '第一页',
                            'lastPageLabel' => '最后页',
                        ],
                        /*定义列表格式*/
                        'columns' => $columns,
                    ]); ?>
                    <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                </form>
            </div>
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
    </div>

    <!--定义数据块-->
<?php $this->beginBlock('test'); ?>
    jQuery(document).ready(function(){
    highlight_subnav('cms-model/index'); //子导航高亮
    });
<?php $this->endBlock() ?>
    <!-- 将数据库块注入到视图中某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END);