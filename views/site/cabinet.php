<?php
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/**
 * @var ActiveDataProvider $transactions
 */

?>

<?php echo "<h1>Hello, " . \Yii::$app->user->identity->username . "!</h1>"; ?>
<p>Take a look at you transactions:</p>


<?php
$dataProvider = new ActiveDataProvider([
    'query' => $transactions,
    'pagination' => [
        'pageSize' => 10,
    ],
]);
echo GridView::widget([
    'dataProvider' => $dataProvider,
]);
?>

