<?php
use yii\helpers\Html;
/**
 * @var yii\web\View $this
 * @var frontend\models\Routing $model
 */
$this->title = 'Create Report';
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-create <?= !\Yii::$app->request->isAjax ? 'wrapper' : '' ?>">
	<?php if(!\Yii::$app->request->isAjax): ?>
	<?= \yii\widgets\Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]); ?>
	<h2><?= Html::encode($this->title) ?></h2>
	<?php endif; ?>
    <?= $this->render('form/_form', [
        'model' => $model,
		'formOptions' => $formOptions,
		'scenario' => $scenario,
		'action' => $action,
		'type' => $type
    ]) ?>
</div>
