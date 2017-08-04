<?php
/**
 * Created by PhpStorm.
 * User: zzx
 * Date: 2017/7/17
 * Time: 2:30
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/*var_dump($model);die();*/
?>

<h1><?= Html::encode($model->username) ?>的个人信息</h1>

<div class="site-updatauser">

    <?php $form = ActiveForm::begin(['id' => 'form-updatauser']) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('确认修改', ['class' => 'btn btn-primary', 'name' => 'updatauser-button']) ?>
    </div>

    <?php $form= ActiveForm::end()  ?>

</div>
