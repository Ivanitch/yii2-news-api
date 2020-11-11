<meta charset="<?= Yii::$app->charset ?>">
<title><?= yii\helpers\Html::encode($this->title) ?></title>
<?= yii\helpers\Html::csrfMetaTags() ?>
<link href="<?= yii\helpers\Url::canonical() ?>" rel="canonical"/>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php $this->head() ?>