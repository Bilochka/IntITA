<?php
/*@var $teacher Teacher*/

$roles = $model->roles();
foreach ($roles as $role) {
    ?>
    <li>
        <a href="#" onclick="loadPage('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
            array('page' => $role->title_en, 'teacher' => $model->teacher_id));?>')">
            <i class="fa fa-table fa-fw"></i> <?php echo $role->title_ua?>
            <?php
            $list = $role->adminPanelList($model);
            if (count($list) > 0){?>
            <span class="fa arrow">
                        <?php }?>
        </a>
        <ul class="nav nav-second-level">
            <?php
            foreach ($list as $attr) {
                ?>
                <li>
                    <a href="#" onclick="getTeacherUserInfo('<?php echo Yii::app()->createUrl('/_teacher/cabinet/getUserInfo',
                        array('user' => $attr["student"], 'role' => $role->title_en));?>')">
                        <?=StudentReg::getUserName($attr["student"]);?>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </li>
<?php
}
?>