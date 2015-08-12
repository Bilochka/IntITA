<?php
/* @var $this LessonController */
/* @var $page LecturePage */
/* @var $lectureElement LectureElement */
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<?php
for ($i = 0, $count = LectureHelper::getNumberLecturePages($page->id_lecture); $i < $count;$i++) {
  ?>
        <a href="<?php $args = $_GET;
        $args['page'] = $i+1;
        echo $this->createUrl('', $args);?>"
           title="Сторінка <?php echo ($i+1);?>">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'pageDone.png');?>">
        </a>
<?php
}?>
<h1 class="lessonPart">
    <div class="labelBlock">
        <p>Сторінка <?php echo $page->page_order . '. ' . $page->page_title; ?></p>
    </div>
</h1>

<h3><label for="pageTitle">Назва сторінки</label></h3>
<?php
$this->widget('editable.EditableField', array(
    'type' => 'text',
    'model' => $page,
    'attribute' => 'page_title',
    'emptytext' => Yii::t('config', '0575'),
    'url' => $this->createUrl('lesson/updateLecturePageAttribute'),
    'placement' => 'right',
));
?>
<br>

<h3><label for="pageVideo">Відео</label></h3>
<?php
if($page->video) {
    $lectureElement = LectureElement::model()->findByPk($page->video);

    $this->widget('editable.EditableField', array(
        'type' => 'textarea',
        'model' => $lectureElement,
        'attribute' => 'html_block',
        'emptytext' => Yii::t('config', '0575'),
        'url' => $this->createUrl('lesson/updateLectureElementAttribute'),
        'placement' => 'right',
    ));
}
?>

<br>
<br>
<fieldset>
    <legend>Текстовий блок:</legend>
    <?php $this->renderPartial('_blocks_list', array('dataProvider' => $dataProvider, 'countBlocks' => $countBlocks, 'editMode' => $editMode, 'user' => $user)); ?>

    <div id="addBlock">
        <?php
        $lecture = Lecture::model()->findByPk($page->id_lecture);
        $this->renderPartial('_addBlock', array('lecture'=>$lecture, 'countBlocks' => $countBlocks, 'editMode' => $editMode, 'teacher' => TeacherHelper::getTeacherId($user)));
        ?>
    </div>
    <br>
    Додати:
    <br>
    <button onclick="addTextBlock('1')"> Текст </button>
    <button onclick="addTextBlock('3')"> Код </button>
    <button onclick="addTextBlock('4')"> Приклад </button>
    <button onclick="addTextBlock('7')"> Інструкція </button>
    <button onclick="addTextBlock('10')"> Формула LaTeX </button>

</fieldset>
<h3><label for="pageQuiz">Завдання (тест) лекції</label></h3>
<?php
    $data = LectureHelper::getPageQuiz($page->id);
if($data) {
    $this->renderPartial('_editTest', array('idBlock' => $data['id_block'], 'editMode' => $editMode));
}
?>