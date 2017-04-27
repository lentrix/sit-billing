<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expense".
 *
 * @property integer $id
 * @property string $date
 * @property string $payee
 * @property string $remarks
 * @property integer $user_id
 *
 * @property User $user
 * @property ExpenseItem[] $expenseItems
 */
class Expense extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expense';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'payee', 'remarks', 'user_id'], 'required'],
            [['date'], 'safe'],
            [['user_id'], 'integer'],
            [['payee'], 'string', 'max' => 255],
            [['remarks'], 'string', 'max' => 60],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'payee' => 'Payee',
            'remarks' => 'Remarks',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenseItems()
    {
        return $this->hasMany(ExpenseItem::className(), ['expense_id' => 'id']);
    }

    public function getTotal() {
        $total = 0;
        foreach($this->expenseItems as $eItem) {
            $total += $eItem->amount;
        }
        return $total;
    }
}
