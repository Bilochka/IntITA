<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 16.06.2015
 * Time: 17:47
 */

$this->breadcrumbs=array(
    'Викладачі'=>array('index'),
    'Ролі викладача',
    'Призначити роль'
);
?>


<div id="addTeacherRole">
    <br>
    <a name="form"></a>
    <form action="<?php echo Yii::app()->createUrl('permissions/setTeacherRole');?>" method="POST" name="add-access">
        <fieldset>
            <legend id="label">Призначити роль викладачу <?php echo $teacher;?>:</legend>
            Викладач:<br>
            <select name="teacher" placeholder="(Виберіть викладача)" autofocus>
                <?php $users = AccessHelper::generateTeachersList();
                $count = count($users);
                for($i = 0; $i < $count; $i++){
                    ?>
                    <option value="<?php echo $users[$i]['id'];?>"><?php echo $users[$i]['alias'];?></option>
                <?php
                }
                ?>
            </select>
            <br>
            <br>
            Роль:<br>
            <select name="role" placeholder="(Виберіть роль)" onchange="javascript:selectRole();">
                <option value="">Всі ролі</option>
                <optgroup label="Виберіть роль">
                    <?php $courses = AccessHelper::generateRolesList();
                    $count = count($courses);
                    for($i = 0; $i < $count; $i++){
                        ?>
                        <option value="<?php echo $courses[$i]['id'];?>"><?php echo $courses[$i]['alias'];?></option>
                    <?php
                    }
                    ?>
            </select>
            <br>
            <br>
            <input type="submit" value="Призначити роль">
    </form>
</div>




<script type="text/javascript">
    function selectRole(){
        var course = $('select[name="course"]').val();
        if(!course){
            $('div[name="selectRole"]').html('');
        }else{
            $.ajax({
                type: "POST",
                url: "/permissions/showRoles",
                data: {course: course},
                cache: false,
                success: function(response){ $('div[name="selectModule"]').html(response); }
            });
        }
    }
</script>