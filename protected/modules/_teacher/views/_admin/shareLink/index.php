<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */
?>

<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('_teacher/_admin/shareLink/create'); ?>')">
            Створити посилання на ресурс
        </button>
    </li>
</ul>
<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#share-link-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="page-header">
<h4>Управління ресурсами для викладачів</h4>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'share-link-grid',
    'dataProvider'=>$model->search(),
    'summaryText'=>'',
    'columns'=>array(
        'name',
        'link',
        array(
            'class'=>'CButtonColumn',
            'headerHtmlOptions' => array('style' => 'width:80px'),
            'buttons'=>array(
                'view' => array
                (
                    'click'=>"function(){
                                    $.fn.yiiGridView.update('share-link-grid', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data){
                                                        fillContainer(data);
                                    }
                                    })
                                    return false;
                              }
                     ",
                    'label'=>'Переглянути',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/shareLink/view", array("id"=>$data->id))',
                ),
                'update' => array
                (
                    'click'=>"function(){
                                    $.fn.yiiGridView.update('share-link-grid', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data){
                                                        fillContainer(data);
                                    }
                                    })
                                    return false;
                              }
                     ",
                    'label'=>'Редагувати',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/shareLink/update", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
)); ?>

