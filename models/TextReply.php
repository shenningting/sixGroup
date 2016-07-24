<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "we_text_reply".
 *
 * @property integer $trid
 * @property integer $reid
 * @property string $trcontent
 */
class TextReply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'we_text_reply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reid'], 'integer'],
            [['trcontent'], 'required'],
            [['trcontent'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'trid' => 'Trid',
            'reid' => 'Reid',
            'trcontent' => 'Trcontent',
        ];
    }
}
