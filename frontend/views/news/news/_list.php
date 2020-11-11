<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
?>
<div class="row row-flex">
    <?php foreach ($dataProvider->getModels() as $item): ?>
        <?= $this->render('_item', [
            'item' => $item
        ]) ?>
    <?php endforeach; ?>
</div>
<!--noindex-->
<!--googleoff:index-->
<div class="row">
    <div class="col-sm-9 text-left not_print">
        <?= \frontend\components\LinkPager::widget([
          'pagination' => $dataProvider->getPagination(),
          'maxButtonCount' => 7
        ]) ?>
    </div>
</div>
<!--googleon:index-->
<!--/noindex-->
