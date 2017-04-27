<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "revenue_item".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $revenue_id
 * @property string $amount
 *
 * @property Account $account
 * @property Revenue $revenue
 */
class RevenueItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'revenue_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'revenue_id', 'amount'], 'required'],
            [['account_id', 'revenue_id'], 'integer'],
            [['amount'], 'number'],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
            [['revenue_id'], 'exist', 'skipOnError' => true, 'targetClass' => Revenue::className(), 'targetAttribute' => ['revenue_id' => 'id']],
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
            'revenue_id' => 'Revenue ID',
            'amount' => 'Amount',
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
    public function getRevenue()
    {
        return $this->hasOne(Revenue::className(), ['id' => 'revenue_id']);
    }
}
