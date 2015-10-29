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

	public function getUrls($id='nitm-reports')
	{
		return [
            $id => $id,
            $id . '/<controller:[\w\-]+>' => $id . '/<controller>/index',
            $id . '/<controller:[\w\-]+>/<action:[\w\-]+>' => $id . '/<controller>/<action>',
            $id . '/<controller:[\w\-]+>/<action:[\w\-]+>/<id:\d+>' => $id . '/<controller>/<action>',
            $id . '/<controller:[\w\-]+>/<action:[\w\-]+>/<type:\w+>' => $id . '/<controller>/<action>',
			'<controller:(reports)>' => $id . '',
			'<controller:(reports)>/<action>' => $id . '/default/<action>',
			'<controller:(reports)>/<action>/<id:\d+>' => $id . '/default/<action>',
			'<controller:(reports)>/<action>/<type:\w+>' => $id . '/default/<action>',
        ];
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
