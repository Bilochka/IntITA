<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 06.09.2015
 * Time: 18:12
 */
?>
<?php if(!isset($editMode)) $editMode=1; ?>
<span class="spoilerLinks" onclick="chapterSpoiler(this);"><span class="spoilerClick" ><span class="spoilerTitle" ><?php echo LectureHelper::getLectureTitle($idLecture); ?></span><div class="spoilerTriangle" id="spoilerTriangle">(<span><?php echo Yii::t('lecture', '0080') ?></span><span id='trg'>&#9660;</span>)</div></span></span>
<div class="spoilerBody" id="spoilerBody">
    <?php

    $summary =  Lecture::getLessonCont($idLecture);

    for($i=0; $i<count($summary);$i++){
        ?>
        <p>
            <a href="<?php $args = $_GET;

            $args['page'] = $passedPages[$i]['order'];
            $args['idCourse'] = ($idCourse)?$idCourse:'0';
            echo $this->createUrl('', $args);?>" class="<?php if($passedPages[$i]['isDone'] || $editMode) echo 'pageAccess' ?>"
               title="<?php echo Yii::t('lecture', '0615')." ".$passedPages[$i]['order'].'. '.strip_tags($summary[$i]);?>">
                <?php echo Yii::t('lecture', '0615')." ".$passedPages[$i]['order'].'. '.strip_tags($summary[$i]);?>
            </a>
        </p>
        <?php
    }

    ?>
</div>
<!-- Spoiler -->
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'chaptersSpoiler.js'); ?>"></script>
<!-- Spoiler -->