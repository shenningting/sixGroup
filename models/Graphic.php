<?php



namespace app\models;



use Yii;



/**

 * This is the model class for table "book".

 *

 * @property integer $book_id

 * @property string $book_name

 * @property string $book_price

 * @property string $book_author

 * @property string $book_img

 * @property string $book_desc

 * @property integer $t_id

 */

class Graphic extends \yii\db\ActiveRecord

{

    /**

     * @inheritdoc

     */

    public static function tableName()

    {

        return 'we_graphic_reply';

    }



    /**

     * @inheritdoc

     */

    public function rules()

    {

        return [

            [['rekeyword'], 'unique','message'=>'关键字不能重复'],

        ];

    }



    /**

     * @inheritdoc

     */

    public function attributeLabels()

    {

        return [

            'gid' => 'GID',

            'aid' => 'AID',

            'rename' => 'RENAME',

            'rekeyword' => 'REKEYWORD',

            'grurl' => 'GRULR',

            'retitle' => 'RETITLE',

            'grdesc' => 'GRDESC',

        ];

    }

}

