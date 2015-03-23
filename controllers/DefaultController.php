<?php

namespace nitm\reports\controllers;

use nitm\controllers\DefaultController as BaseController;
use nitm\reports\models\Reports;
use nitm\reports\models\search\Reports as ReportsSearch;

class DefaultController extends BaseController
{
	
	public function init()
	{
		parent::init();
		$this->model = new Reports(['scenario' => 'default']);
	}
	
    public function actionIndex()
    {
		return parent::actionIndex(ReportsSearch::className(), [
			'with' => [
				'author', 'editor'
			],
			//'defaultParams' => [$this->model->formName() => ['closed' => 0]]
		]);
    }
}
