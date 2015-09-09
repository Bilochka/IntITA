<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property integer $id_record
 * @property integer $id
 * @property string $language
 * @property string $translation
 *
 * The followings are the available model relations:
 * @property Sourcemessages $id0
 */
class Messages extends CActiveRecord
{
    public $comment;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'messages';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, language, translation', 'required'),
            array('id', 'numerical', 'integerOnly' => true),
            array('language', 'length', 'max' => 16),
            array('comment', 'length', 'max' => 255),
            // The following rule is used by search().
            array('id_record, id, language, translation, comment', 'safe', 'on' => 'search'),
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
            'id0' => array(self::BELONGS_TO, 'Sourcemessages', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_record' => 'Id запису',
            'id' => 'ID повідомлення',
            'language' => 'Мова',
            'translation' => 'Переклад',
            'comment' => 'Коментар',
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
        $criteria = new CDbCriteria;

        $criteria->compare('id_record', $this->id_record);
        $criteria->compare('id', $this->id);
        $criteria->compare('language', $this->language, true);
        $criteria->compare('translation', $this->translation, true);
        $criteria->compare('comment', $this->comment, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Messages the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function addNewRecord($id, $language, $translation)
    {
        $model = new Messages();

        $model->id = $id;
        $model->language = $language;
        $model->translation = $translation;

        return $model->save();
    }

    public static function addMessageCodeComment($code, $comment)
    {
        return Yii::app()->db->createCommand()->insert(
            'message_comment',
            array(
                'message_code' => $code,
                'comment' => $comment,
            )
        );
    }

    public static function updateMessageCodeComment($code, $comment)
    {
        if (MessageComment::model()->exists('message_code=:code', array(':code' => $code))){
            MessageComment::model()->updateByPk($code, array('comment' => $comment));
        } else{
            $model = new MessageComment();

            $model->message_code = $code;
            $model->comment = $comment;

            $model->save();
        }
     }
}
