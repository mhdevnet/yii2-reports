<?php

use yii\widgets\ListView;
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
<div class="col-md-3 col-lg-3 absolute full-height" id="reports-container">
	<?= $createButton; ?>
    <?= ListView::widget([
		'summary' => false,
		'options' => [
			'id' => 'reports',
			'class' => 'wrapper',
		],
		'itemOptions' => [
			'tag' => false
		],
		'dataProvider' => $dataProvider,
		'itemView' => function($model, $key, $index, $widget) {
			return $this->render('view', [
				'model' => $model
			]);
		},
		'pager' => [
			'class' => \nitm\widgets\ias\ScrollPager::className(),
			'overflowContainer' => '#reports-container',
			'container' => '#reports',
			'item' => ".reports-item",
			'negativeMargin' => 150,
			'delay' => 1000,
		]
	]);
	?>
</div>
<div class="col-md-9 col-lg-9 col-md-offset-3 col-lg-offset-3 absolute collapsable full-height filter shadow" id="critical-updates">
</div>
