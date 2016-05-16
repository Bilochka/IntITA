<div class="row">
    <div class="col-lg-12">
        Викладач
    </div>
</div>
<hr>
<div class="row" id="dashboard">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php //echo $teacher->countNotCheckedPlainTask(); ?></div>
                        <div>Задачі до перегляду</div>
                    </div>
                </div>
            </div>
            <a href="#"
               onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_teacher_consultant/teacherConsultant/showTeacherPlainTaskList',
                   array("idTeacher" => Yii::app()->user->getId())) ?>', 'Задачі до перевірки')">
                <div class="panel-footer">
                    <span class="pull-left">Продивитись</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>