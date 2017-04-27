<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expense_item".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $expense_id
 * @property string $amount
 *
 * @property Expense $expense
 * @property Account $account
 */
class ExpenseItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expense_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'expense_id', 'amount'], 'required'],
            [['account_id', 'expense_id'], 'integer'],
            [['amount'], 'number'],
            [['expense_id'], 'exist', 'skipOnError' => true, 'targetClass' => Expense::className(), 'targetAttribute' => ['expense_id' => 'id']],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_id' => 'Account ID',
            'expense_id' => 'Expense ID',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpense()
    {
        return $this->hasOne(Expense::className(), ['id' => 'expense_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}
