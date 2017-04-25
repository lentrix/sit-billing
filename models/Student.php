<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property string $lname
 * @property string $fname
 * @property string $mname
 * @property string $address
 * @property string $phone
 * @property integer $level
 *
 * @property Receipt[] $receipts
 */
class Student extends \yii\db\ActiveRecord
{
    public static $_levels =  [
        0 => "Nursery",
        1 => "Kindergarten 1",
        2 => "Kindergarten 2",
        3 => "Grade 1",
        4 => "Grade 2",
        5 => "Grade 3",
        6 => "Grade 4",
        7 => "Grade 5",
        8 => "Grade 6",
        9 => "Grade 7",
        10 => "Grade 8",
        11 => "Grade 9",
        12 => "Grade 10",
        13 => "Grade 11",
        14 => "Grade 12",
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lname', 'fname', 'mname', 'address', 'level'], 'required'],
            [['level'], 'integer'],
            [['lname', 'fname', 'mname'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lname' => 'Last Name',
            'fname' => 'First Name',
            'mname' => 'Middle Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'level' => 'Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceipts()
    {
        return $this->hasMany(Receipt::className(), ['student_id' => 'id']);
    }

    public function getFormalName() {
        return $this->lname . ", " . $this->fname . " " . $this->mname;
    }

    public function getCasualName() {
        return $this->fname . " " . substr($this->mname, 0, 1) . ". " . $this->lname;
    }
}
