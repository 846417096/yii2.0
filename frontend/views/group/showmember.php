<?php
/**
 * Created by PhpStorm.
 * User: zzx
 * Date: 2017/7/21
 * Time: 14:55
 */
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

$this->title = "团队成员";


?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    foreach ($data as $k => $v) {
        ?>
        <?= DetailView::widget([
            'model' => $v,
            'attributes' => [
                'id',
                'username',
                'email',
            ],
        ]) ?>
    <?php } ?>

</div>
