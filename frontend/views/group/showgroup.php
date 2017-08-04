<?php
/**
 * Created by PhpStorm.
 * User: zzx
 * Date: 2017/7/21
 * Time: 10:58
 */
use yii\helpers\Html;
use yii\widgets\DetailView;



$this->title ="团队的资料";

?>
<div class="user-view">

    <?php ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?= DetailView::widget([
        'model' => $data,
        'attributes' => [
            'id',
            'user_id',
            'name',
            'desc',
            'created_time',
        ],
    ]) ?>

    <?= Html::a('查看部门', ['/department/viewdepartment', 'gid' => $data->id], ['class' => 'btn btn-primary']) ?>

    <?= Html::a('查看团队成员', ['/group/viewmember', 'gid' => $data->id], ['class' => 'btn btn-primary']); ?>

    <?= Html::a('加入团队', ['/group/joingroup', 'gid' => $data->id], ['class' => 'btn btn-primary']); ?>

</div>

