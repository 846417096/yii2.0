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

<?php
$action = Yii::$app->controller->action->id;
if ($action == "index") {
    echo "<h2>" . Html::a('新建团队', ['/group/signup'], ['class' => 'btn btn-primary']) . "</h2>";
}
if ($action == "mygroup") {
    echo "<h2>" . Html::a('所有团队', ['/group/index'], ['class' => 'btn btn-primary']) . "</h2>";
}
?>

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
                        <?= $id = $v['id']; ?>
                    </td>
                    <td>
                        <?= $uid = $v['user_id']; ?>
                    </td>

                    <td>
                        <?= $gname = $v['name']; ?>
                    </td>

                    <td>
                        <?= $time = $v['created_time']; ?>
                    </td>

                    <td>
                        <?= Html::a('加入团队', ['/group/joingroup', 'gid' => $id], ['class' => 'btn btn-primary']); ?>
                    </td>

                    <td>
                        <?= Html::a('查看团队', ['/group/viewgroup', 'gid' => $id], ['class' => 'btn btn-primary']); ?>
                    </td>

                    <td>
                        <?= Html::a('查看团队成员', ['/group/viewmember', 'gid' => $id], ['class' => 'btn btn-primary']); ?>
                    </td>
                    <?php
                    $id = Yii::$app->user->getId();
                    if ($id == $uid) {
                        echo "<td>";
                        ?>
                        <?= Html::a('管理团队', ['/group/', 'gid' => $id], ['class' => 'btn btn-primary']); ?>
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