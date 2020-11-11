<?php
/* @var $this \yii\web\View */
/* @var $content string */
use frontend\assets\AppAsset;
use yii\widgets\Breadcrumbs;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= $this->render("//common/head") ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="wrap">
    <div id="content">
        <?= $this->render("//common/header") ?>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= \common\components\Noty::run() ?>
                    <?= $content ?>
                </div>
                <!--noindex-->
                <!--googleoff:index-->
                <div class="col-md-3">
                    <?= $this->render("//common/aside") ?>
                </div>
                <!--googleon:index-->
                <!--/noindex-->
            </div>
        </div>
    </div>
    <?= $this->render("//common/footer") ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
