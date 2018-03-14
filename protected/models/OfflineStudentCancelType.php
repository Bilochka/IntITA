<?php

/**
 * This is the model class for table "offline_student_cancel_type".
 *
 * The followings are the available columns in table 'offline_student_cancel_type':
 * @property integer $id
 * @property string $description
 */
class OfflineStudentCancelType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'offline_student_cancel_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description', 'required'),
			array('description', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'description' => 'Description',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OfflineStudentCancelType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getAllCause(){
	    $reasons = self::model()->findAll();
	    $result = array();
	    foreach($reasons as $item){
	        array_push($result, array('id'=>$item->id, 'description'=>$item->description));
        }
	    return $result;
    }

    public static function breaksList(){
//        $param = Yii::app()->session["lg"]?"title_".Yii::app()->session["lg"]:"title_ua";
        $criteria = new CDbCriteria();
        $breaks = OfflineStudentCancelType::model()->findAll($criteria);
        $data = array();

        foreach ($breaks as $key=>$break) {
            $data[$key]['id']=$break['id'];
            $data[$key]['description']=$break['description'];
        }
        return json_encode($data);
    }
}