<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegisteredUser
 *
 * @author alterego4
 */
class RegisteredUser
{
    //put your code here
    //StudentReg variable
    public $registrationData;
    //array UserRoles
    private $_roles;
    //Teacher model
    private $_teacher;
    private $_isTeacher = false;
    private $_roleAttributes = array();
    private $_teacherRoles = array( UserRoles::TRAINER, UserRoles::CONSULTANT);

    public function __construct(StudentReg $registrationData)
    {
        $this->registrationData = $registrationData;
    }

    public static function userById($id = null)
    {
        if (($id !== null) && (($registrationData = StudentReg::model()->findByPk($id)) !== null)) {
            return new RegisteredUser($registrationData);
        }
        //TODO:
        throw new CDbException('500', "No such user");
    }

    //Model Methods
    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->registrationData, $name), $arguments);
    }

    public function __get($name)
    {
        return $this->registrationData->$name;
    }

    public function getRoles()
    {
        if ($this->_roles === null) {

            $this->_roles = $this->loadRoles();
        }
        return $this->_roles;
    }

    private function loadRoles()
    {
        $sql = '(select "admin",id_user from user_admin a where a.id_user = ' . $this->id . ' and end_date IS NULL)
                    union
                (select "accountant", id_user from user_accountant ac where ac.id_user = ' . $this->id . ' and end_date IS NULL)
                    union
                (select "student", id_user from user_student st where st.id_user = ' . $this->id . ' and end_date IS NULL)
                     union
                (select "trainer", id_user from user_trainer at where at.id_user = ' . $this->id . ' and end_date IS NULL)
                     union
                (select "consultant", id_user from user_consultant acs where acs.id_user = ' . $this->id . ' and end_date IS NULL)';
        $rolesArray = Yii::app()->db->createCommand($sql)->queryAll();

        $result = array_map(function ($row) {
            return new UserRoles($row["admin"]);
        }, $rolesArray);

        return $result;
    }

    public function isTeacher()
    {
        if ($this->getTeacher() === null) {
            return false;
        } else {
            return true;
        }
    }

    public function getTeacher()
    {
        if ($this->_teacher === null) {

            $this->_teacher = $this->loadTeacherModel();
        }
        return $this->_teacher;
    }

    private function loadTeacherModel()
    {
        return Teacher::model()->findByAttributes(array('user_id' => $this->registrationData->id));
    }

    public function getRolesAttributes()
    {
        if (empty($this->_roleAttributes)) {
            foreach ($this->getRoles() as $role) {
                $this->loadAttributes($role);
            }
        }
        return $this->_roleAttributes;
    }

    public function getAttributesByRole(UserRoles $role)
    {
        if (empty($this->_roleAttributes)) {
            $this->loadAttributes($role);
        }
        return $this->_roleAttributes[(string)$role];
    }

    private function loadAttributes(UserRoles $role){
        if ($this->hasRole($role)) {
            $roleObj = Role::getInstance($role);
            $this->_roleAttributes[(string)$role] = $roleObj->attributes($this->registrationData);
        }
        return $this->_roleAttributes[(string)$role];
    }

    public function setRoleAttribute($role, $attribute, $value){
        $roleObj = Role::getInstance($role);
        return $roleObj->setAttribute($this->registrationData, $attribute, $value);
    }

    public function unsetRoleAttribute($role, $attribute, $value){
        $roleObj = Role::getInstance($role);
        return $roleObj->cancelAttribute($this->registrationData, $attribute, $value);
    }

    public function isAdmin()
    {
        return in_array(UserRoles::ADMIN, $this->getRoles());
    }

    public function isAccountant()
    {
        return $this->hasRole(UserRoles::ACCOUNTANT);
    }

    public function isTrainer()
    {
        return $this->hasRole(UserRoles::TRAINER);
    }

    public function isConsultant()
    {
        return $this->hasRole(UserRoles::CONSULTANT);
    }

    public function isStudent()
    {
        return $this->hasRole(UserRoles::STUDENT);
    }

    public function isAuthor()
    {
        return TeacherModule::model()->exists('idTeacher=:teacher', array('teacher' => $this->getTeacher()->teacher_id));
    }

    public function hasRole($role)
    {
        return in_array($role, $this->getRoles());
    }

    public function setRole($role)
    {
        if ($this->hasRole($role)) {
            throw new \application\components\Exceptions\IntItaException(400, "User already has this role.");
        }
        $roleObj = Role::getInstance($role);
        return $roleObj->setRole($this->registrationData);
    }

    public function cancelRole(UserRoles $role)
    {
        if (!$this->hasRole($role)) {
            throw new \application\components\Exceptions\IntItaException(400, "User hasn't this role.");
        }
        $roleObj = Role::getInstance($role);
        return $roleObj->cancelRole($this->registrationData);
    }

    public function teacherRoles()
    {
        return array_intersect($this->getRoles(), $this->_teacherRoles);
    }

    public function noSetTeacherRoles()
    {
        return array_diff($this->_teacherRoles, array_intersect($this->getRoles(), $this->_teacherRoles));
    }
}
