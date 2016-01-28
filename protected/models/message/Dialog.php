<?php

class Dialog
{
    public $sender;
    public $receiver;
    public $messages;

    public function __construct(StudentReg $sender, StudentReg $receiver){
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->messages = $this->messages();
    }

    public function messages()
    {
        $criteria = new CDbCriteria();
        $criteria->alias = 'um';
        $criteria->join = 'LEFT JOIN messages as m ON um.id_message = m.id';
        $criteria->join.= ' LEFT JOIN message_receiver as r ON um.id_message = r.id_message';
        $criteria->order = 'm.create_date DESC';
        $criteria->addCondition ('m.sender = '.$this->sender->id.' and r.id_receiver='.$this->receiver->id, 'OR');
        $criteria->addCondition ('m.sender = '.$this->receiver->id.' and r.id_receiver='.$this->sender->id, 'OR');

        $this->messages = UserMessages::model()->findAll($criteria);
        return $this;
    }

    public function deleteDialog()
    {
        foreach($this->messages as $message){
            if($message->deleteMessage($this->receiver) == false)
                return false;
        }
        return true;
    }

    public function readDialog($dialog){
        $flag = true;
        foreach($dialog as $message){
            $flag = $message->read($this);
        }
        return $flag;
    }

    public function isRead(){
        return true;
    }
}