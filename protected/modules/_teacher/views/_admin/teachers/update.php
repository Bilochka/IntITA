<?php
/* @var $model Teacher */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/index'); ?>',
                'Викладачі')">Викладачі</button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/create'); ?>',
                'Додати викладача')">Додати викладача</button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/showTeacher', array('id' => $model->user_id)); ?>',
                'Переглянути інформацію про викладача')">
                Переглянути інформацію про викладача</button>
        </li>
    </ul>
    <div class="page-header">
        <h4>Оновлення інформації про викладача
            <?php echo "{$model->lastName()} {$model->firstName()} {$model->middleName()}"; ?>
        </h4>
    </div>
<?php $this->renderPartial('_form', array('model' => $model, 'scenario' => 'update')); ?>