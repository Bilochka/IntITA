<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 16.11.2015
 * Time: 16:41
 */

abstract class Slider extends CActiveRecord {

    public function getLastOrder()
    {
        $row = Yii::app()->db->createCommand(array(
            'select' => array('MAX(car.`order`) as ordermax'),
            'from' => 'carousel as car',
        ))->queryRow();
        return $row['ordermax'];
    }

    public static function sortOrder($model)
    {
        if($model == 'Carousel')
            $all = Carousel::model()->findAll();

        elseif($model == 'AboutUs')
            $all = AboutusSlider::model()->findAll();

        for($i = 0;$i < count($all);$i++)
        {
            $all[$i]->order = $i + 1;
            $all[$i]->save();
        }

    }

    public static function swapImage($model,$prevModel)
    {
        $tmp = $model->order;
        $model->order = $prevModel->order;
        $prevModel->order = $tmp;
    }

    public function getLastAboutusOrder()
    {
        $row = Yii::app()->db->createCommand(array(
            'select' => array('MAX(about.`order`) as ordermax'),
            'from' => 'aboutus_slider as about',
        ))->queryRow();
        return $row['ordermax'];
    }
}