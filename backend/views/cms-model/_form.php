<?php

use common\helpers\Html;
use common\core\ActiveForm;
use common\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\CmsModel */
/* @var $form ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'options' => [
        'class' => 'form-aaa'
    ]
]); ?>

<?= $form->field($model, 'name')->textInput(['class' => 'form-control c-md-2'])->label('文章模型名称')->hint('模型名称'); ?>

<?= $form->field($model, 'category_tpl')->textInput(['class' => 'form-control c-md-2'])->label('栏目模型')->hint('英文标识，只允许含有:英文、数字和下划线'); ?>

<?= $form->field($model, 'content_tpl')->textInput(['class' => 'form-control c-md-2'])->label('文章模型')->hint('英文标识，只允许含有:英文、数字和下划线'); ?>

<?= $form->field($model, 'ext_fields')->textInput(['class' => 'form-control c-md-2'])->label('扩展字段')->hint(''); ?>

<div class="form-actions">
    <?= Html::submitButton('<i class="icon-ok"></i>确定', ['class' => 'btn blue ajax-post', 'target-form' => 'form-aaa']) ?>
    <?= Html::button('取消', ['class' => 'btn']) ?>
</div>

<?php ActiveForm::end(); ?>



