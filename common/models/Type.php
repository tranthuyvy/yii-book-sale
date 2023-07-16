<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%type}}".
 *
 * @property int $id
 * @property string $type_name
 *
 * @property TypeDetail[] $typeDetails
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%type}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_name'], 'required'],
            [['type_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_name' => 'Type Name',
        ];
    }

    /**
     * Gets query for [[TypeDetails]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TypeDetailQuery
     */
    public function getTypeDetails()
    {
        return $this->hasMany(TypeDetail::class, ['type_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TypeQuery(get_called_class());
    }
}
