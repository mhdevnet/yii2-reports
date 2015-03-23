<?php
use yii\helpers\Html;
/**
 * @var yii\web\View $this
 * @var frontend\models\Reports $model
 */
$this->title = 'Update Report' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reports-update <?= !\Yii::$app->request->isAjax ? 'wrapper' : '' ?>" id='update-report<?=$model->getId()?>'>
	<?php if(!\Yii::$app->request->isAjax): ?>
	<?= \yii\widgets\Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]); ?>
	<?php endif; ?>
    <?= $this->render('form/_form', [
        'model' => $model,
		'formOptions' => $formOptions,
		'scenario' => $scenario,
		'action' => $action,
		'type' => $type
    ]) ?>
</div>
