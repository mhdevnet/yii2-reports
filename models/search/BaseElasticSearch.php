<?php

namespace nitm\reports\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BaseElasticSearch provides the basic search functionality based on the class it extends from.
 */
class BaseElasticSearch extends \nitm\search\BaseElasticSearch
{	
	use \nitm\traits\Cache, \nitm\traits\Nitm;
	
	public static $namespace = "\\nitm\\models\\";
}