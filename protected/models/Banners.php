<?php

/**
 * This is the model class for table "banners".
 *
 * The followings are the available columns in table 'banners':
 * @property integer $id
 * @property string $file_path
 * @property integer $slide_position
 * @property integer $visible
 * @property string $url
 */
class Banners extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'banners';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file_path', 'required'),
			array('slide_position, visible', 'numerical', 'integerOnly'=>true),
			array('file_path, url', 'length', 'max'=>255),
			array('url', 'url'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, file_path, slide_position, visible', 'safe', 'on'=>'search'),
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
			'file_path' => 'File Path',
			'slide_position' => 'Slide Position',
			'visible' => 'Visible',
			'url' => 'Url',
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
		$criteria->compare('file_path',$this->file_path,true);
		$criteria->compare('slide_position',$this->slide_position);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('url',$this->url);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Banners the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function uploadBanner(){
	    $path =  $path=Yii::getPathOfAlias('webroot')."/images/banners";
	    if (!is_dir($path)){
	        mkdir($path,0777,true);
        }
        $image = $_FILES['file'];
        $img = new CUploadedFile($image['name'],$image['tmp_name'],$image['type'],$image['size'],$image['error']);
        if($img->saveAs("{$path}/{$image['name']}")){
            $this->file_path = '/images/banners/'.$img->getName();
            if($this->save()){
                return true;
            }
        }
        return false;

    }

    public function delete(){
        if(parent::delete()){
            $this->deleteImageFile();
            return true;
        }
	    return false;
    }

    public function changeStatus(){
        $this->visible = (int)!$this->visible;
        return $this->save();
    }

    public function deleteImageFile(){
        $file =  $path=Yii::getPathOfAlias('webroot').$this->file_path;
        return @unlink($file);
    }

    public function changePosition($position){
	    if ($this->slide_position > $position){
	        $recalcBanners = Banners::findAll('slide_position < :position',['position'=>$this->slide_position]);
	        foreach ($recalcBanners as $newPos){
	            $newPos->slide_position = ++$newPos->slide_position;
	            $newPos->save();
            }

        }
        else{
            $recalcBanners = Banners::findAll('slide_position > :position',['position'=>$this->slide_position]);
            foreach ($recalcBanners as $newPos){
                $newPos->slide_position = --$newPos->slide_position;
                $newPos->save();
            }
        }
	    $this->slide_position = $position;
	    return $this->save();
    }
}
