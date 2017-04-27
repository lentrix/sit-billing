<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "revenue".
 *
 * @property integer $id
 * @property string $date
 * @property integer $student_id
 * @property string $payor
 * @property string $remarks
 * @property integer $user_id
 *
 * @property Student $student
 * @property User $user
 * @property RevenueItem[] $revenueItems
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
            [['date', 'user_id'], 'required'],
            [['date'], 'safe'],
            [['student_id', 'user_id'], 'integer'],
            [['payor'], 'string', 'max' => 255],
            [['remarks'], 'string', 'max' => 60],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
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
            'student_id' => 'Student ID',
            'payor' => 'Payor',
            'remarks' => 'Remarks',
            'user_id' => 'User ID',
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
    public function getRevenueItems()
    {
        return $this->hasMany(RevenueItem::className(), ['revenue_id' => 'id']);
    }

    public function getTotal() {
        $total = 0;
        foreach($this->revenueItems as $rItem) {
            $total += $rItem->amount;
        }
        return $total;
    }
}
