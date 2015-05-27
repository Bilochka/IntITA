<?php
/* @var $this MytestController */
/* @var $model Teacher */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'teacher-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'lang'); ?>
		<?php echo $form->textField($model,'lang',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'lang'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>35,'maxlength'=>35)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'middle_name'); ?>
		<?php echo $form->textField($model,'middle_name',array('size'=>35,'maxlength'=>35)); ?>
		<?php echo $form->error($model,'middle_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>35,'maxlength'=>35)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'foto_url'); ?>
		<?php echo $form->textField($model,'foto_url',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'foto_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subjects'); ?>
		<?php echo $form->textField($model,'subjects',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'subjects'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profile_text_first'); ?>
		<?php echo $form->textArea($model,'profile_text_first',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'profile_text_first'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profile_text_short'); ?>
		<?php echo $form->textArea($model,'profile_text_short',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'profile_text_short'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profile_text_last'); ?>
		<?php echo $form->textArea($model,'profile_text_last',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'profile_text_last'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'readMoreLink'); ?>
		<?php echo $form->textField($model,'readMoreLink',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'readMoreLink'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tel'); ?>
		<?php echo $form->textField($model,'tel',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'tel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'skype'); ?>
		<?php echo $form->textField($model,'skype',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'skype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'linkName'); ?>
		<?php echo $form->textField($model,'linkName',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'linkName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'smallImage'); ?>
		<?php echo $form->textField($model,'smallImage',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'smallImage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rate_knowledge'); ?>
		<?php echo $form->textField($model,'rate_knowledge'); ?>
		<?php echo $form->error($model,'rate_knowledge'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rate_efficiency'); ?>
		<?php echo $form->textField($model,'rate_efficiency'); ?>
		<?php echo $form->error($model,'rate_efficiency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rate_relations'); ?>
		<?php echo $form->textField($model,'rate_relations'); ?>
		<?php echo $form->error($model,'rate_relations'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sections'); ?>
		<?php echo $form->textArea($model,'sections',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'sections'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'courses'); ?>
		<?php echo $form->textField($model,'courses',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'courses'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'foto_url_short'); ?>
		<?php echo $form->textField($model,'foto_url_short',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'foto_url_short'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->