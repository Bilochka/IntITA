<?php $order = CourseModules::model()->count("id_course=$newmodel->course_ID"); ?>
<form id="addLessonForm" action="<?php echo Yii::app()->createUrl('module/saveModule');?>" method="post">
    <br>
    <span id="formLabel"><?php echo Yii::t('course', '0365') ?></span>
    <br>
    <span><?php echo Yii::t('course', '0366')." ".($order + 1).". "; ?></span>
    <br>
    <input name="idCourse" value="<?php echo $newmodel->course_ID;?>" hidden="hidden">
    <input name="order" value="<?php echo $order+1?>" hidden="hidden">
    <input name="lang" value="<?php echo $newmodel->language;?>" hidden="hidden">
    <span>Назва (UA)</span>
    <input type="text" name="titleUA" id="titleUA" required pattern="^[=а-еж-щьюяА-ЕЖ-ЩЬЮЯa-zA-Z0-9ЄєІіЇї.,<>:;`'?!~* ()/+-]+$" maxlength="255" size="60">
    <br>
    <span>Назва (RU)</span>
    <input type="text" name="titleRU" id="titleRU" pattern="^[=а-яА-ЯёЁa-zA-Z0-9.,<>:;`'?!~* ()/+-]+$" maxlength="255" size="60">
    <br>
    <span>Назва (EN)</span>
    <input type="text" name="titleEN" id="titleEN" pattern="^[=zA-Z0-9.,<>:;`'?!~* ()/+-]+$" maxlength="255" size="60">
    <br>
    <input type="submit"  value="<?php echo Yii::t('course', '0367') ?>" id="submitButton" onclick="trimModuleName()">
</form>
<button id="cancelButton" onclick="hideForm('moduleForm', 'titleUA', 'titleRU', 'titleEN')"><?php echo Yii::t('course', '0368') ?></button>