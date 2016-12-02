<?php

namespace frontend\models;

use Yii;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "Product".
 *
 * @property integer $id
 * @property string $product_id
 * @property string $title
 * @property string $description
 * @property string $rating
 * @property double $price
 * @property string $image
 * @property integer $views
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'views'], 'integer'],
            [['description'], 'string'],
            [['rating', 'price'], 'number'],
            [['title', 'image'], 'string', 'max' => 255],
            //['title',  'match', 'pattern' => '/^[а-яё0-9 ]+$/iu'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'ProdID',
            'title' => 'Наименование',
            'description' => 'Описание',
            'rating' => 'Рейтинг',
            'price' => 'Цена',
            'image' => 'Ссылка на изображение',
            'views' => 'Просмотры',
        ];
    }

}
