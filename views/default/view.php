<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use kartik\icons\Icon;

/**
 * @var yii\web\View $this
 * @var nitm\module\models\Reports $model
 */

$this->title = $model->name." based on ".$model->project;
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reports-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => new ArrayDataProvider([
			'allModels' => [$model],
			'pagination' => false,
		]),
        'columns' => [
            'created_at:datetime',
            'name',
        ],
		'afterRow' => function ($model, $key, $index, $grid) {
			return Html::tag('tr', 
				Html::tag(
					'td', 
					$model->notes, 
					[
						'colspan' => 6, 
						'rowspan' => 1
					]
				)
			);
		}
    ]) ?>

</div>
