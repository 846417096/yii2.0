<?php
/**
 * Created by PhpStorm.
 * User: zzx
 * Date: 2017/7/20
 * Time: 14:28
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = "创建团队";

?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
