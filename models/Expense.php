<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "disbursement".
 *
 * @property integer $id
 * @property string $date
 * @property integer $account_id
 * @property string $amount
 * @property integer $user_id
 * @property string $remarks
 *
 * @property Account $account
 * @property User $user
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
            [['date'], 'safe'],
            [['account_id', 'amount', 'user_id'], 'required'],
            [['account_id', 'user_id'], 'integer'],
            [['amount'], 'number'],
            [['remarks'], 'string', 'max' => 60],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
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
            'account_id' => 'Account ID',
            'amount' => 'Amount',
            'user_id' => 'User ID',
            'remarks' => 'Remarks',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
