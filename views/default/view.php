<?php

use yii\helpers\Html;
use yii\grid\GridView;
use nitm\helpers\Icon;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var frontend\models\search\Prefixes $searchModel
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model = isset($dataProvider) ? $dataProvider->allModels[0] : $model;
$dataProvider = isset($dataProvider) ? $dataProvider : new \yii\data\ArrayDataProvider([
	'allModels' => [$model]
]);

/**
 * Setup the report
 */
$report->initial_project = $model->project;            // Name of report project folder    
$report->initial_report = $model->report; 


?>
<?php 
	if(!\Yii::$app->request->isAjax && !isset($noBreadcrumbs))
		echo \yii\widgets\Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]);
?>
<?=
	$report->execute();
?>