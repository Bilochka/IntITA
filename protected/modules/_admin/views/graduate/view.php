<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/adminGraduate.css" />
<br>
<br>
<button type="button" class="btn btn-link">
<a href="<?php echo Yii::app()->createUrl('/_admin/graduate/create');?>">Додати випускника</a>
</button>
    <br>
<button type="button" class="btn btn-link">
<a href="<?php echo Yii::app()->createUrl('/_admin/graduate/index');?>">Список випускників</a>
</button>
    <br>
<button type="button" class="btn btn-link">
<a href="<?php echo Yii::app()->createUrl('/_admin/graduate/update', array('id' => $model->id));?>">Редагувати інформацію про випускника</a>
</button>
<div class="page-header">
<h1>Переглянути інформацію про випускника #<?php echo $model->first_name." ".$model->last_name;?> </h1>
</div>
    <div class="graduateView">
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'first_name',
			'last_name',
			array(
				'header' => 'Аватар',
				'value' => StaticFilesHelper::createPath('image', 'graduates', $model->avatar),
				'type' => 'image',
			),
			'graduate_date',
			'position',
			'work_place',
			'work_site',
			'courses_page',
			'rate',
			'recall',
			'first_name_en',
			'last_name_en',
		),
	)); ?>
</div>
