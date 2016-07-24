<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "we_menu".
 *
 * @property integer $mid
 * @property integer $aid
 * @property string $mgrade
 * @property string $mname
 * @property string $url
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'we_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid'], 'integer'],
            [['mgrade'], 'string', 'max' => 10],
            [['mname', 'url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mid' => 'Mid',
            'aid' => 'Aid',
            'mgrade' => 'Mgrade',
            'mname' => 'Mname',
            'url' => 'Url',
        ];
    }
}
