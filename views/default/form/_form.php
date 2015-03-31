<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \nitm\reports\models\Reports */
/* @var $form ActiveForm */

?>
<div class="row" id="<?= $formOptions['options']['id']; ?>-container">

	<div class="col-md-12 col-lg-12">
    <?php $form = include(\Yii::getAlias("@nitm/views/layouts/form/header.php")); ?>

		<?=
			$form->field($model, 'name');
		?>
		<?=
			$form->field($model, 'notes')->textarea().
			Html::activeHiddenInput($model, 'project');
		?>
		<div class="form-group">
			<div class="col-md-2 col-lg-2 control-label">
				<h4>Project</h4>
			</div>
			<div class="col-md-9 col-lg-9">
			<?=
				Html::tag('h3', ucfirst($model->project), ['class' => 'text-info']);
			?>
			</div>
		</div>
		<?=
			$form->field($model, 'report')->dropDownList($model->getReports($model->project));
		?>
		
		<?php if(!\Yii::$app->request->isAjax): ?>
		<div class="fixed-actions text-right">
			<?= Html::submitButton(ucfirst($action), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<br><br><br>
		</div>
		<?php endif; ?>
		<?php include(\Yii::getAlias("@app/views/layouts/form/footer.php")); ?>
	</div>

</div><!-- default-forms-_form -->
