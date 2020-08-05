<?php
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/**
 * @var ActiveDataProvider $users
 */

?>

<?php if (Yii::$app->user->isGuest) { ?>
    <h1>Hi there, you can see data if you are logged in only, sorry!</h1>
    <p>Log in to see the info about other users!)</p>
<?php } else { ?>
    <?php echo "<h1>Hello, " . \Yii::$app->user->identity->username . "!</h1>"; ?>
    <p>Take a look at users:</p>


    <?php
    $dataProvider = new ActiveDataProvider([
        'query' => $users,
        'pagination' => [
            'pageSize' => 10,
        ],
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
    ]);
    ?>
<?php } ?>
