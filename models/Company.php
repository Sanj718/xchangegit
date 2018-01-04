<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $name
 * @property string $about
 * @property int $person_id
 *
 * @property Person $person
 * @property Person[] $people
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['about'], 'string'],
            [['person_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'about' => 'About',
            'person_id' => 'Person Name',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);

    }


    public function getAddress_p()
    {
        $add = $this->getPerson()->one()->getAddress()->one();
        return $add;
    }
    public function getFullAddress_p() {
        return $this->getAddress_p()->street . ' ' . $this->getAddress_p()->city . ' ' . $this->getAddress_p()->country;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['company_id' => 'id']);
    }
}
