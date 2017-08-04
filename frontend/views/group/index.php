<?php
/**
 * Created by PhpStorm.
 * User: zzx
 * Date: 2017/7/19
 * Time: 17:39
 */
use yii\helpers\Html;

$this->title = "团队";


?>

<h2>
    <?= Html::a('新建团队', ['/group/signup'], ['class' => 'btn btn-primary']); ?>
    <?= Html::a('恢复组织', ['/group/rewrite'], ['class' => 'btn btn-primary']) ?>
</h2>

<div class="panel panel-default">
    <!-- Default panel contents -->

    <!--<h2> <? /*= Yii::$app->controller->action->id */ ?> </h2>-->

    <div class="panel-heading">搜索结果</div>
    <!-- Table -->
    <table class="table">
        <tr>
            <td>组织id</td>
            <td>创建人id</td>
            <td>组织</td>
            <td>创建时间</td>
        </tr>
        <?php

        if (is_array($data)) {
            foreach ($data as $k => $v) {
                ?>
                <tr>
                    <td>
                        <?= $v['id']; ?>
                    </td>
                    <td>
                        <?= $v['user_id']; ?>
                    </td>

                    <td>
                        <?= $v['name']; ?>
                    </td>

                    <td>
                        <?= $v['created_time']; ?>
                    </td>

                    <td>
                        <?= Html::a('查看团队', ['/group/viewgroup', 'gid' => $v['id']], ['class' => 'btn btn-primary']); ?>
                    </td>

                    <?php
                    $id = Yii::$app->user->getId();
                    $controname=Yii::$app->controller->action;
                    if ($id == $v['user_id']) {
                        echo "<td>";
                        ?>
                        <?= Html::a('管理团队', ['/group/', 'gid' => $v['id']], ['class' => 'btn btn-primary']); ?>
                        <?= Html::a('删除团队', ['/group/delete', 'gid' => $v['id']], ['class' => 'btn btn-primary']); ?>
                        <?php
                        echo "</td>";
                    }
                    ?>

                </tr>
                <?php
            }
        }
        ?>

    </table>
</div>