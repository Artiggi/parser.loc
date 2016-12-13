<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "viewstat".
 *
 * @property integer $id
 * @property integer $prod_id
 * @property string $viewtime
 * @property string $daystat
 *
 * @property Product $prod
 */
class Viewstat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'viewstat';
    }


    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'viewtime',
                'updatedAtAttribute' => 'viewtime',
                'value' => function() { return date ('U');}
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prod_id'], 'required'],
            [['prod_id', 'viewtime'], 'integer'],
            [['prod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['prod_id' => 'id']],
            [['daystat'], 'string', 'max' => 255],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prod_id' => 'Prod ID',
            'viewtime' => 'Viewtime',
            'daystat' => 'Daystat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProd()
    {
        return $this->hasOne(Product::className(), ['id' => 'prod_id']);
    }
}
