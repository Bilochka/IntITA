<?php
/**
 * @var $user RegisteredUser
 * @var $model StudentReg
 */
$teacher = $user->getTeacher();
?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <ul class="list-group">
                <?php
                $this->renderPartial('/_content_manager/_moduleList', array(
                    'attribute' => $user->getAttributesByRole(UserRoles::AUTHOR)["module"],
                    'model' => $user->registrationData,
                    'role' => 'author'
                ));
                ?>
            </ul>
        </div>
    </div>
</div>