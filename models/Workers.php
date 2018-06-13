<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "workers".
 *
 * @property string $name
 * @property string $surname
 * @property string $function
 * @property string $phone
 * @property string $email
 * @property string $birth
 * @property string $img_src
 */
class Workers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workers';
    }

    /**
     * @inheritdoc//
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'function', 'phone', 'email', 'birth', 'img_src'], 'required'],            
            [['name', 'surname'], 'string', 'max' => 30],
            [['function'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 10],
            [['email'], 'string', 'max' => 50],
	    [['email'], 'email'],
//	    [['img_src'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
	    [['img_src'], 'image', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxSize' => 1000000, 'minSize' => 5000, 'tooSmall' => 'Слишком маленькое изображение', 'tooBig' => 'Слишком большое изображение'],
	    
//	    [['birth'], 'date', 'format' => 'y-m-d', 'message' => 'Введите дату в формате гггг-мм-дд'],
	    //[['birth'], ['1930-01-01', '2018-01-01'], 'date', 'format' => 'y-m-d', 'message' => 'Введите дату в формате гггг-мм-дд'],
	    [['birth'], function ($attribute, $params) {
                if (($this->$attribute > date('Y-m-d'))||($this->$attribute < '1930-01-01')) {
                    $this->addError($attribute, 'Дата вне разумных пределов');
                }
            }],
	    ['phone', function ($attribute, $params) {
                if (!ctype_digit($this->$attribute)) {
                    $this->addError($attribute, 'Телефон может содержать только цифры.');
                }
            }],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->img_src->saveAs('uploads/' . $this->img_src->baseName . '.' . $this->img_src->extension);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'function' => 'Должность',
            'phone' => 'Мобильный телефон',
            'email' => 'E-mail',
            'birth' => 'Дата рождения в формате ГГГГ-ММ-ДД',
            'img_src' => 'Адрес фото',
        ];
    }
    
    
}
