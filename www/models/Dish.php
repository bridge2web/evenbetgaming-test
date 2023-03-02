<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dish".
 *
 * @property int $id
 * @property string $name
 * @property int $cook_id
 *
 * @property Cook $cook
 * @property DishOrder[] $dishOrders
 */
class Dish extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dish';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'cook_id'], 'required'],
            [['cook_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['cook_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cook::class, 'targetAttribute' => ['cook_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'cook_id' => 'Cook ID',
        ];
    }

    /**
     * Gets query for [[Cook]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCook()
    {
        return $this->hasOne(Cook::class, ['id' => 'cook_id']);
    }

    /**
     * Gets query for [[DishOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDishOrders()
    {
        return $this->hasMany(DishOrder::class, ['dish_id' => 'id']);
    }
}
