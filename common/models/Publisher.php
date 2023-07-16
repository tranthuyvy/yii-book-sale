<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%publisher}}".
 *
 * @property int $id
 * @property string $publisher_name
 *
 * @property Products[] $products
 */
class Publisher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%publisher}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['publisher_name'], 'required'],
            [['publisher_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'publisher_name' => 'Publisher Name',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ProductsQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::class, ['publisher_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PublisherQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PublisherQuery(get_called_class());
    }
}
