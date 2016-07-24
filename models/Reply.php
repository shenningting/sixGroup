<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "we_reply".
 *
 * @property integer $reid
 * @property integer $aid
 * @property string $rename
 * @property string $rekeyword
 * @property string $retype
 */
class Reply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'we_reply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid'], 'integer'],
            [['rename', 'rekeyword'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reid' => 'Reid',
            'aid' => 'Aid',
            'rename' => 'Rename',
            'rekeyword' => 'Rekeyword',
            'retype' => 'Retype',
        ];
    }
}
