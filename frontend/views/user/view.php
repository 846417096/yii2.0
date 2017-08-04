<?php
/**
 * Created by PhpStorm.
 * User: zzx
 * Date: 2017/7/18
 * Time: 10:57
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
$this->title = $model->username;

/*var_dump($model);
die();*/

?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['/user/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
</div>