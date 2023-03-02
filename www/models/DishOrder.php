<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dish_order".
 *
 * @property int $id
 * @property int $dish_id
 * @property int $order_id
 * @property int $created_at
 *
 * @property Dish $dish
 * @property Order $order
 */
class DishOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dish_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dish_id', 'order_id', 'created_at'], 'required'],
            [['dish_id', 'order_id', 'created_at'], 'integer'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['order_id' => 'id']],
            [['dish_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dish::class, 'targetAttribute' => ['dish_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dish_id' => 'Dish ID',
            'order_id' => 'Order ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Dish]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDish()
    {
        return $this->hasOne(Dish::class, ['id' => 'dish_id']);
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }
}
