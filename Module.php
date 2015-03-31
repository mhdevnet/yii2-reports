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
	
	public function getProjects()
	{
		return (new \nitm\helpers\Directory)->getDirectories('@runtime/reportico/projects');
	}
	
	public function getReports($project)
	{
		return (new \nitm\helpers\Directory)->getFilesMatching('@runtime/reportico/projects/'.$project, ['xml']);
	}
}
