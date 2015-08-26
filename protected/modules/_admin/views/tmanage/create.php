<?php
/* @var $model Teacher */
$this->breadcrumbs=array(
    'Викладачі'=>array('index'),
    'Додати викладача',
);
$this->menu=array(
    array('label'=>'Всі викладачі', 'url'=>array('index')),
    array('label'=>'Управління викладачами', 'url'=>array('admin')),
);
?>

    <h1>Додати викладача</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'scenario' => 'create')); ?>