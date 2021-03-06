<?php

/**
 * Created by PhpStorm.
 * User: anton
 * Date: 23.06.16
 * Time: 22:08
 */
class RevisionCommon {

    /**
     * @param null $idModule
     * @param null $organization
     * @return array
     */
    public function getReleasedLectures($idModule = null, $organization=null) {

        $command = Yii::app()->db->createCommand();
        $command
            ->select('vc_lecture.*, vc_lecture_properties.*')
            ->from('vc_lecture')
            ->join('vc_lecture_properties', 'vc_lecture_properties.id = vc_lecture.id_properties')
            ->join('module', 'module.module_ID = vc_lecture.id_module')
            ->where('vc_lecture_properties.id_state = ' . RevisionState::ReadyForRelease);

        if ($idModule) {
            $command->andWhere('vc_lecture.id_module = ' . $idModule);
        }
        if ($organization) {
            $command->andWhere('module.id_organization = ' . $organization);
        }

        $data['proposed_to_release'] = $command->queryAll();

        $command = Yii::app()->db->createCommand();
        $command
            ->select('vc_lecture.*, vc_lecture_properties.*')
            ->from('vc_lecture')
            ->join('vc_lecture_properties', 'vc_lecture_properties.id = vc_lecture.id_properties')
            ->join('module', 'module.module_ID = vc_lecture.id_module')
            ->where('vc_lecture_properties.id_state = ' . RevisionState::ApprovedState);

        if ($idModule) {
            $command->andWhere('vc_lecture.id_module = ' . $idModule);
        }
        if ($organization) {
            $command->andWhere('module.id_organization = ' . $organization);
        }

        $data['approved'] = $command->queryAll();

        $command = Yii::app()->db->createCommand();
        $command
            ->select('vc_lecture.*, vc_lecture_properties.*')
            ->from('vc_lecture')
            ->join('vc_lecture_properties', 'vc_lecture_properties.id = vc_lecture.id_properties')
            ->join('module', 'module.module_ID = vc_lecture.id_module')
            ->where('vc_lecture_properties.id_state = ' . RevisionState::ReleasedState);

        if ($idModule) {
            $command->andWhere('vc_lecture.id_module = ' . $idModule);
        }
        if ($organization) {
            $command->andWhere('module.id_organization = ' . $organization);
        }

        $data['released'] = $command->queryAll();

        return $data;
    }

    /**
     * @return array
     */
    public function getAllModules($categories, $organization) {
        if(empty($categories)){
            $command = Yii::app()->db->createCommand();
            $command
                ->select('module.*')
                ->from('module')
                ->where('(module.status_online = ' . Module::READY.' or module.status_offline = ' . Module::READY.') and module.cancelled='.Module::ACTIVE.' 
                and module.id_organization='.$organization);

            $data['ready_module'] = $command->queryAll();

            $command = Yii::app()->db->createCommand();
            $command
                ->select('module.*')
                ->from('module')
                ->where('module.status_online = ' . Module::DEVELOP.' and module.status_offline = ' . Module::DEVELOP.' and module.cancelled='.Module::ACTIVE.' 
                and module.id_organization='.$organization);

            $data['develop_module'] = $command->queryAll();
        }else{
            //            todo select by tag
//            $categoriesIds=array();
//            foreach ($categories as $key=>$categoryId){
//                if($categoryId=='true') array_push($categoriesIds, $key);
//            }
            $command = Yii::app()->db->createCommand();
            $command
                ->select('module.*')
                ->from('module')
                ->where('(module.status_online = ' . Module::READY.' or module.status_offline = ' . Module::READY.') and module.cancelled='.Module::ACTIVE.' 
                and module.id_organization='.$organization);

            $data['ready_module'] = $command->queryAll();

            $command = Yii::app()->db->createCommand();
            $command
                ->select('module.*')
                ->from('module')
                ->where('module.status_online = ' . Module::DEVELOP.' and module.status_offline = ' . Module::DEVELOP.' and module.cancelled='.Module::ACTIVE.' 
                and module.id_organization='.$organization);

            $data['develop_module'] = $command->queryAll();
        }

        return $data;
    }
}