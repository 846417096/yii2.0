<?php
/**
 * Created by PhpStorm.
 * User: zzx
 * Date: 2017/7/16
 * Time: 20:57
 */
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->username . "的资料";

?>

<div class="user-view">
    <h2><?= Html::encode($model->username) ?></h2>

    <p>
        <?= Html::a('修改您的信息', ['site/updatauser', 'model' => $model], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email',
        ],
    ]);
    ?>
</div>
