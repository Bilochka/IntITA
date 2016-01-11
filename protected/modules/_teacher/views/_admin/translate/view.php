<?php
/* @var $this MessagesController */
/* @var $model Translate */
?>

<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/translate/index'); ?>')">
            Інтерфейсні повідомлення</button>
    </li>
</ul>

<div class="page-header">
    <h1>Повідомлення #<?php echo $model->id_record; ?></h1>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id_record',
        'id',
        'language',
        'translation',
    ),
)); ?>
<br>
<div class="page-header">
    <b>Коментар:</b>   <?php echo MessageComment::getMessageCommentById($model->id); ?>
</div>
<br>
<br>
<div class="page-header">
    <b>Категорія:</b>  <?php echo Sourcemessages::getMessageCategory($model->id); ?>
</div>
