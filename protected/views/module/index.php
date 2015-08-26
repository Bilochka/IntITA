<?php
Yii::app()->clientScript->registerMetaTag(Yii::app()->createAbsoluteUrl(Yii::app()->request->url), null, null, array('property' => "og:url"));
Yii::app()->clientScript->registerMetaTag(ModuleHelper::getModuleName($post->module_ID), null, null, array('property' => "og:title"));
Yii::app()->clientScript->registerMetaTag("Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали", null, null, array('property' => "og:description"));
Yii::app()->clientScript->registerMetaTag(StaticFilesHelper::createPath('image', 'module', $post->module_img), null, null, array('property' => "og:image"));
?>
<div id="sharing">
    <div class="share42init" data-top1="75" data-top2="110" data-margin="15"
         data-url="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->request->url) ?>"
         data-title="<?php echo ModuleHelper::getModuleName($post->module_ID);?>"
         data-image="<?php echo StaticFilesHelper::createPath('image', 'module', $post->module_img);?>"
         data-description="Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали"
         data-path="<?php echo Yii::app()->request->baseUrl; ?>/scripts/share42/"
         data-zero-counter="1">
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/share42/share42.js"></script>
<!-- Module style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/module.css" />

<?php
$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Yii::app()->request->baseUrl."/courses",CourseHelper::getCourseName($idCourse) =>Yii::app()->createUrl('course/index', array('id' => $idCourse)),ModuleHelper::getModuleName($post->module_ID),
);
?>

<div class="ModuleBlock">
    <?php $this->renderPartial('_leftModule', array('post' => $post, 'dataProvider' =>$dataProvider, 'editMode' => $editMode, "idCourse"=>$idCourse));?>

    <div class="rightModule">
         <?php $this->renderPartial('_teacherBox', array('teachers' => $teachers));?>
    </div>

</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/module.js"></script>

