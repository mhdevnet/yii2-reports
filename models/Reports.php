<?php

namespace nitm\reports\models;

use Yii;

/**
 * This is the model class for table "{{%reports}}".
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $added
 * @property integer $editor_id
 * @property string $edited
 * @property string $name
 * @property string $notes
 * @property integer $disabled
 * @property integer $edits
 * @property string $last_run_on
 * @property integer $last_run_by
 */
class Reports extends \nitm\models\Entity
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reports';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'notes', 'project', 'report'], 'required', 'on' => ['create', 'update']],
            [['author_id', 'editor_id', 'disabled', 'edits', 'last_run_by'], 'integer'],
            [['added', 'edited', 'last_run_on'], 'safe'],
            [['notes'], 'string'],
            [['name'], 'string', 'max' => 128]
        ];
    }
	
	public function scenarios()
	{
		return [
			'create' => ['name', 'notes', 'project', 'report', 'disabled'],
			'update' => ['name', 'notes', 'disabled', 'last_run_by'],
			'default' => [],
		];
	}
	
	public static function has()
	{
		$has = [
			'author' => null, 
			'editor' => null,
			'disabled' => null,
		];
		return array_merge(parent::has(), $has);
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'author_id' => Yii::t('app', 'Author ID'),
            'added' => Yii::t('app', 'Added'),
            'editor_id' => Yii::t('app', 'Editor ID'),
            'edited' => Yii::t('app', 'Edited'),
            'name' => Yii::t('app', 'Name'),
            'notes' => Yii::t('app', 'Notes'),
            'disabled' => Yii::t('app', 'Disabled'),
            'edits' => Yii::t('app', 'Edits'),
            'last_run_on' => Yii::t('app', 'Last Run On'),
            'last_run_by' => Yii::t('app', 'Last Run By'),
        ];
    }
	
	public function getProjects()
	{
		return \Yii::$app->getModule('nitm-reports')->getProjects();
	}
	
	public function getReports($project)
	{
		return \Yii::$app->getModule('nitm-reports')->getReports($project);
	}
}
