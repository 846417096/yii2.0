<?php
/**
 * Created by PhpStorm.
 * User: zzx
 * Date: 2017/7/24
 * Time: 10:34
 */
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

$this->title = '团队部门';


?>

<h2><?= Html::encode($this->title) ?></h2>

<?= Html::a('返回', ['/group/mygroup'], ['class' => 'btn btn-primary']); ?>


<?php
if (is_object($model)) {
    $id = Yii::$app->user->getId();
    if ($id == $model[0]->user_id) {
        echo Html::a('创建部门', ['/department/signup', 'gid' => $model[0]->group_id], ['class' => 'btn btn-primary']);
        foreach ($model as $k => $v) {
            echo DetailView::widget([
                'model' => $v,
                'attributes' => [
                    'group_id',
                    'user_id',
                    'name',
                    'desc',
                    'created_time',
                ],
            ]);
        }
    } else {
        echo "<h1>该团队还没有部门</h1>";
    }
}
?>
