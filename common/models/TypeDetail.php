<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%type_detail}}".
 *
 * @property int $id
 * @property int $type_id
 * @property int $product_id
 *
 * @property Products $product
 * @property Type $type
 */
class TypeDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%type_detail}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'product_id'], 'required'],
            [['type_id', 'product_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Type ID',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ProductsQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::class, ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TypeQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::class, ['id' => 'type_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TypeDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TypeDetailQuery(get_called_class());
    }
}
