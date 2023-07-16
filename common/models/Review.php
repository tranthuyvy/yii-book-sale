<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%reviews}}".
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $comments
 * @property int|null $star
 * @property int|null $created_at
 * @property int $created_by
 *
 * @property User $createdBy
 * @property Products $product
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%reviews}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'created_by'], 'required'],
            [['product_id', 'star', 'created_at', 'created_by'], 'integer'],
            [['comments'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'comments' => 'Comments',
            'star' => 'Star',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
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
     * {@inheritdoc}
     * @return \common\models\query\ReviewQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ReviewQuery(get_called_class());
    }
}
