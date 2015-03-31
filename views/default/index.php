<?php

use yii\widgets\ListView;
use yii\helpers\Html;
use nitm\helpers\Icon;

/**
 * @var yii\web\View $this
 */
$this->title = 'Reports';
$iasOptions = [
	'container' => '#reports-container',
	'ias' => [
		'container' => '#reports',
		'item' => ".row",
		'negativeMargin' => 250,
		'delay' => 1000,
	],
	'IASNoneLeftExtension' => [
		'text' =>'No more'
	],
	'IASTriggerExtension' => [
		'text' =>'More'
	]
];

?>
<div class="col-md-2 col-lg-2 absolute collapsable full-height" id="reports-container">
<br>
	<?=
		\yii\bootstrap\ButtonDropdown::widget([
			'label' => 'Select Report Type',
			'options' => [
				'class' => 'btn btn-primary btn-lg',
			],
			'dropdown' => [
				'items' => \Yii::$app->getModule('nitm-reports')->getNavItems()
			]
		]);
	?>
<br><br>
	<div class="absolute" style="height:95%" id="reports-list">
		<?= ListView::widget([
			'summary' => false,
			'options' => [
				'id' => 'reports',
			],
			'dataProvider' => $dataProvider,
			'itemView' => function($model, $key, $index, $widget) {
				return Html::a(Html::tag('h3', $model->name)
					.Html::tag('div', $model->notes, ['class' => 'list-group-item-text'])
					.Html::tag('span', '', ['class' => 'badge']), 
					\Yii::$app->urlManager->createUrl(['/reports/view/'.$model->getId(),
						'__noNav' => 1
					]), [
						'title' => Yii::t('yii', 'View report '.$model->name),
						'class' => 'list-group-item',
						'data-parent' => 'tr',
						'data-pjax' => '0',
						'role' => 'dynamicIframe',
						'data-id' => '#report-results',
						'data-indicator' => '#report-title'
					]);
			},
			'itemOptions' => [
				'tag' => false,
				'class' => 'list-group-item'
			],
			'pager' => [
				'class' => \nitm\widgets\ias\ScrollPager::className(),
				'overflowContainer' => '#reports-container',
				'container' => '#reports',
				'item' => ".item",
				'negativeMargin' => 150,
				'delay' => 1000,
			]
		]) ?>
	</div>
</div>
<div class="col-md-10 col-lg-10 col-md-offset-2 col-lg-offset-2 absolute full-height shadow" id="reports-results-container">
	<?php if(\Yii::$app->user->getIdentity()->isAdmin()): ?>
	<br>
	<div class="center-block text-right"><?= $createButton; ?></div>
	<?php endif; ?>
	<br>
	<h1 class="text-center" id="report-title">
		Select a report from the left
	</h1>
	<iframe id="report-results" style="border:none;width:100%; height:100%">
	</iframe>
</div>
<script type="text/javascript">
$nitm.onModuleLoad('tools', function (module) {
	module.initDynamicIframe();
});
</script>