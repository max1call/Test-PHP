<?php

namespace app\models;

class TimeForm extends \yii\db\ActiveRecord
{    
    public static function tableName() {
	return 'rememder';
    }

    public function rules()
    {
        return [
            [['day', 'hour'], 'required'],            
            [['day'], 'integer', 'max' => 365],
            [['hour'], 'integer', 'max' => 24],
        ];
    }
    public function attributeLabels()
    {
        return [
            'day' => 'Дней',
            'hour' => 'Часов',            
        ];
    }
    
}
