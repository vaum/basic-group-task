<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


/**
 * @property $id
 * @property string $username
 * @property string $balance
 */
class User extends ActiveRecord implements IdentityInterface
{

    /**
     * @param $username
     * @return User|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return false;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentityByAccessToken($token, $type = null) {}
}
