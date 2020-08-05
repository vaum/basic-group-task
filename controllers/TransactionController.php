<?php


namespace app\controllers;


use app\models\Transaction;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class TransactionController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionCreate()
    {
        $transaction = new Transaction();
        $users = $this->getUserArray();

        if ($form = \Yii::$app->request->post()) {

            if (!$transaction->customValidate($form)) {
                return $this->render('create', [
                    'availableUsers' => $users,
                    'model' => $transaction,
                    'status' => $transaction::TRANSACTION_STATUS[$transaction::TRANSACTION_FAILED]
                ]);
            }

            $transaction->sender = \Yii::$app->user->identity->username;
            $transaction->receiver = User::find()->where(['id' => $form['Transaction']['receiver']])->one()->username;
            $transaction->amount = $form['Transaction']['amount'];
            $transaction->dateTime = date('Y-m-d H:i:s');

            if ($transaction->updateBalances() === $transaction::TRANSACTION_FAILED) {
                return $this->render('create', [
                    'availableUsers' => $users,
                    'model' => $transaction,
                    'status' => $transaction::TRANSACTION_STATUS[$transaction::TRANSACTION_FAILED]
                ]);
            }

            if ($transaction->save()) {
                return $this->redirect(['site/user-list']);
            }
        }

        return $this->render('create', [
            'availableUsers' => $users,
            'model' => $transaction,
            'status' => $transaction::TRANSACTION_STATUS[$transaction::TRANSACTION_SUCCESS]
        ]);
    }

    private function getUserArray()
    {
        $users = ArrayHelper::map(User::find()->all(),
            'id', 'username');
        $currentUserId = \Yii::$app->user->identity->id;
        unset($users[$currentUserId]);

        return $users;
    }

}
