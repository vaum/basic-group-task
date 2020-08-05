<?php


namespace app\models;


use yii\db\ActiveRecord;

/**
 * Class Transaction
 * @package app\models
 *
 * @property integer $id
 * @property string $sender
 * @property string $receiver
 * @property float $amount
 * @property \DateTime $dateTime
 *
 * @property User $user
 */
class Transaction extends ActiveRecord
{
    const BALANCE_MINIMUM = -1000;

    const TRANSACTION_SUCCESS = 100;
    const TRANSACTION_FAILED = 200;

    const TRANSACTION_STATUS = [
        self::TRANSACTION_SUCCESS => "Success",
        self::TRANSACTION_FAILED => "Failed"
    ];

    public function customValidate($attributes = [])
    {
        return true;
    }

    public function rules()
    {
        return [
            [['sender', 'receiver', 'amount'], 'required'],
            [['amount'], 'number', 'numberPattern' => '/^\d+(.\d{1,2})?$/'],
        ];
    }

    public function updateBalances()
    {
        $sender = User::findOne(['username' => $this->sender]);
        $receiver = User::findOne(['username' => $this->receiver]);

        if (false === $this->updateSenderBalance($sender, $this->amount)) {
            return self::TRANSACTION_FAILED;
        }

        $this->updateReceiverBalance($receiver, $this->amount);

        return self::TRANSACTION_SUCCESS;
    }

    /**
     * @param User $sender
     * @param float $transactionAmount
     * @return bool
     */
    public function updateSenderBalance($sender, float $transactionAmount)
    {

        if (floatval($transactionAmount) <= 0) return false;

        $newBalance = floatval($sender->balance) - floatval($transactionAmount);

        if ($newBalance < self::BALANCE_MINIMUM) return false;

        $sender->balance = $newBalance;

        return $sender->save();
    }

    /**
     * @param User $receiver
     * @param float $transactionAmount
     * @return bool
     */
    public function updateReceiverBalance($receiver, float $transactionAmount)
    {
        $receiver->balance = floatval($receiver->balance) + floatval($transactionAmount);
        return $receiver->save();
    }
}
