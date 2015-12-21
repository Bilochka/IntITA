<br>
<br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/module/create'); ?>">Створити модуль</a>

<div class="page-header">
    <h2>Модулі</h2>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'module-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'htmlOptions' => array('class' => 'grid-view custom'),
    'pager' => array(
        'firstPageLabel' => '&#171;&#171;',
        'lastPageLabel' => '&#187;&#187;',
        'prevPageLabel' => '&#171;',
        'nextPageLabel' => '&#187;',
        'header' => '',
        'cssFile' => Config::getBaseUrl() . '/css/pager.css'
    ),
    'summaryText' => '',
    'columns' => array(
        'module_ID',
        'module_number',
        'alias',
        'title_ua',
        'language',
        'module_price',
        'level',
        array(
            'name' => 'cancelled',
            'value' => '$data->cancelledTitle()',
        ),
        array(
            'name' => 'status',
            'value' => '$data->statusTitle()',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}{restore}{statusUp}{statusDown}',
            'deleteConfirmation' => "Ви підтверджуєте видалення модуля?",
            'headerHtmlOptions' => array('style' => 'width:120px'),
            'buttons' => array(
                'restore' => array
                (
                    'label' => 'Відновити модуль',
                    'url' => 'Yii::app()->createUrl("/_admin/module/restore", array("id"=>$data->primaryKey))',
                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'restore.png'),
                    'options' => array(
                        'class' => 'controlButtons;',
                    )
                ),
                'statusUp' => array
                (
                    'label' => 'Статус модуля',
                    'url' => 'Yii::app()->createUrl("/_admin/module/upStatus", array("id"=>$data->primaryKey))',
                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'down.png'),
                    'options' => array(
                        'class' => 'controlButtons;',
                    )
                ),
                'statusDown' => array
                (
                    'label' => 'Статус модуля',
                    'url' => 'Yii::app()->createUrl("/_admin/module/downStatus", array("id"=>$data->primaryKey))',
                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'up.png'),
                    'options' => array(
                        'class' => 'controlButtons;',
                    )
                )

            ),
        ),
    ),
)); ?>

<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'ajaxModule.js'); ?>"></script>
