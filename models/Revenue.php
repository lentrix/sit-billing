<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "revenue".
 *
 * @property integer $id
 * @property string $date
 * @property integer $account_id
 * @property integer $student_id
 * @property string $amount
 * @property string $remarks
 * @property integer $user_id
 *
 * @property Student $student
 * @property User $user
 * @property Account $account
 */
class Revenue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'revenue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['account_id', 'amount', 'user_id'], 'required'],
            [['account_id', 'student_id', 'user_id'], 'integer'],
            [['amount'], 'number'],
            [['remarks'], 'string', 'max' => 60],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'date' => 'Date',
            'account_id' => 'Account',
            'student_id' => 'Student',
            'amount' => 'Amount',
            'remarks' => 'Remarks',
            'user_id' => 'User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
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
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}
