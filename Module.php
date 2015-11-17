<?php

namespace nitm\reports;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'nitm\reports\controllers';

	public $types = [];

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

	public function getNavItems()
	{
		$ret_val = [];
		foreach($this->types as $type)
		{
			$ret_val[] = [
				'label' => ucFirst($type),
				'url' => '/reports/index/'.$type
			];
		}
		return $ret_val;
	}

	public function getUrls($id = 'nitm-reports')
	{
		$parameters = [];
		$routeHelper = new \nitm\helpers\Routes([
			'moduleId' => $id,
			'map' => [
				//'type-id' => '<controller:%controllers%>/<action>/<type>/<id:\d+>',
				'type' => '<controller:%controllers%>/<action>/<type:\w+>',
				'id' => '<controller:%controllers%>/<action>/<id:\d+>',
				'action-only' => '<controller:%controllers%>/<action>',
				'none' => '<controller:%controllers%>'
			],
			'controllers' => [
				'default' => [
					'alias' => ['report']
				],
			]
		]);
		$routeHelper->pluralize();
		$parameters = array_keys($routeHelper->map);
		$routes = $routeHelper->create($parameters);
		return $routes;
	}

	protected function bootstrap($app)
	{
		/**
		 * Setup urls
		 */
        $app->getUrlManager()->addRules($this->getUrls(), false);
	}

	public function getProjects()
	{
		return (new \nitm\helpers\Directory)->getDirectories('@runtime/reportico/projects');
	}

	public function getReports($project)
	{
		return (new \nitm\helpers\Directory)->getFilesMatching('@runtime/reportico/projects/'.$project, ['xml']);
	}
}
