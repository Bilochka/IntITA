<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 22.12.2015
 * Time: 17:07
 */
?>

<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'roles.css'); ?>"/>
<div class="col-md-12">

    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/create'); ?>',
                        ' Додати викладача')">
                Додати викладача</button>
        </li>
    </ul>
<?php
$this->widget('application.components.MyGridView', array(
    'id' => 'tmanage',
    'dataProvider' => $model->search(),
    'summaryText' => '',
    'pager' => array(
        'firstPageLabel' => '&#171;&#171;',
        'lastPageLabel' => '&#187;&#187;',
        'prevPageLabel' => '&#171;',
        'nextPageLabel' => '&#187;',
        'header' => '',
        'cssFile' => StaticFilesHelper::fullPathTo('css', 'pager.css'),
    ),
    'columns' => array(
        array(
            'header' => 'ПІБ',
            'value' => '"{$data->last_name} {$data->first_name} {$data->middle_name}"',
        ),
        'email',
        array(
            'header' => 'Статус',
            'value' => '($data->isPrint == 1)?"активний":"видалено"',
        ),
        array(
            'class' => 'CButtonColumn',
            'headerHtmlOptions' => array('style' => 'width:80px'),
            'buttons'=>array(
                'delete' => array
                (
                    'click' => "function(){
                                    showConfirm('Ви дійсно хочете видалити вчителя?',$(this).attr('href'))
                                    return false;
                              }
                     ",
                    'label' => 'Видалити',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/teachers/delete", array("id"=>$data->primaryKey))',
                ),
                'view' => array
                (
                    'click'=>"function(){
                                    $.fn.yiiGridView.update('tmanage', {
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
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/teachers/showTeacher", array("id"=>$data->user_id))',
                ),
                'update' => array
                (
                    'click'=>"function(){
                                    $.fn.yiiGridView.update('tmanage', {
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
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/teachers/update", array("id"=>$data->primaryKey))',
                ),

            ),
    ),
    ),
)); ?>

