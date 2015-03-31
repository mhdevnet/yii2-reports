<?php

namespace nitm\reports\controllers;

use nitm\controllers\DefaultController as BaseController;
use nitm\reports\models\Reports;
use nitm\reports\models\search\Reports as ReportsSearch;
use nitm\helpers\Response;
use yii\helpers\ArrayHelper;

class DefaultController extends BaseController
{
	
	public function init()
	{
		parent::init();
		$this->model = new Reports(['scenario' => 'default']);
	}
	
    public function actionIndex($type)
    {
		return parent::actionIndex(ReportsSearch::className(), [
			'with' => [
				'author', 'editor'
			],
			'createOptions' => [
				'toggleButton' => [
					'label' => \nitm\helpers\Icon::forAction('plus').strtoupper(" Create ".$type." Report"), 
					'href' => \Yii::$app->urlManager->createUrl([
						'/'.$this->model->isWhat().'/form/create/', 
						'__format' => 'modal', 
						'report-type' => $type
					])
				]
			],
			'params' => [$this->model->formName() => ['project' => $type]],
			'defaultParams' => [$this->model->formName() => ['project' => 'routing']]
		]);
    }
	
	/**
     * View a model.
     * @type integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		Response::$forceAjax = true;
		
		$reportico = \Yii::$app->getModule('reportico');
		$engine = $reportico->getReporticoEngine();        // Fetches reportico engine
		$engine->access_mode = "ONEREPORT";             // Allows access to report output only
		$engine->initial_execute_mode = "EXECUTE";         // Just executes specified report
		$engine->bootstrap_styles = "3";                   // Set to "3" for bootstrap v3, "2" for V2 or false for no bootstrap
		$engine->force_reportico_mini_maintains = true;    // Often required
		$engine->bootstrap_preloaded = true;               // true if you dont need Reportico to load its own bootstrap
		$engine->clear_reportico_session = true;           // Normally required
		
		$engine->output_template_parameters["show_hide_navigation_menu"] = "show";   
        $engine->output_template_parameters["show_hide_dropdown_menu"] = "show";
        $engine->output_template_parameters["show_hide_report_output_title"] = "hide";
        $engine->output_template_parameters["show_hide_prepare_section_boxes"] = "hide";
        $engine->output_template_parameters["show_hide_prepare_pdf_button"] = "hide";
        $engine->output_template_parameters["show_hide_prepare_html_button"] = "hide";
        $engine->output_template_parameters["show_hide_prepare_print_html_button"] = "show";
        $engine->output_template_parameters["show_hide_prepare_csv_button"] = "hide";
        $engine->output_template_parameters["show_hide_prepare_page_style"] = "hide";

		return parent::actionView($id, null, [
			'view' => '/default/view',
			'args' => [
				'report' => $engine,
				'noBreadcrumbs' => true
			]
		]);
	}
	
	/*
	 * Get the forms associated with this controller
	 * @type string $type What are we getting this form for?
	 * @type int $unique The id to load data for
	 * @return string | json
	 */
	public function actionForm($type=null, $id=null)
	{
		$this->model->project = ArrayHelper::getValue(\Yii::$app->request->get(), 'report-type', 'routing');
		$options = [
			'title' => function ($model) {
				if($model->isNewRecord)
					return 'Create '.$model->project.' Report';
				else
					return 'Update '.$model->project.' Report: '.$model->name;
			},
		];
		$options['force'] = true;
		return parent::actionForm($type, $id, $options);
	}
}
