<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 15:49
 */
?>
<div class="bgBlue" id="xex">
    <table>
        <tr>
            <td valign="top">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'courses', 'teacher1232.png');?>">
            </td>
            <td>
                <div id='coursesHeader'>
                    <p class="coursesInfoBlock"><?php echo Yii::t('courses', '0148'); ?>

                    </p>
                    <div id="detailCourseInfoLarge<?php echo $index ?>" class="collapse">
                        <div class="courseBox2">
                            <?php echo Yii::t('courses', '0229');?>
                        </div>
                    </div>
            </td>
        </tr>
    </table>
    <a href="#detailCourseInfoLarge<?php echo $index?>" data-toggle="collapse" style="color: #000;" id="showMyTextLarge" class="detailCourseInfoLarge collapsed">
        <span ng-click="isDeploy = !isDeploy" ng-show="!isDeploy" class="expandText">
                розгорнути &#9662;
            </span>
        <span ng-click="isDeploy = !isDeploy" ng-show="isDeploy" class="expandText">
                згорнути&#9652;
            </span>
    </a>
</div>