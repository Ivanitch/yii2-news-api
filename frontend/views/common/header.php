<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=\yii\helpers\Url::home()?>">Название сайта</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li id="page_about">
                    <a href="/about">О сайте</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false">Пункт с подпунктами 1<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Подпункт 1.1</a></li>
                        <li><a href="#">Подпункт 1.2</a></li>
                        <li><a href="#">Подпункт 1.3</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Подпункт 1.4</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Подпункт 1.5</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Найти">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <? if (!Yii::$app->user->isGuest): ?>
                    <? if (Yii::$app->user->can('admin')): ?>
                        <li><a href="<?= Yii::$app->params['backendHostInfo'] ?>"><i class="fa fa-desktop"></i></a></li>
                    <? endif; ?>
                    <li><a href="/logout"><i class="fa fa-sign-out"></i></a></li>
                <? else: ?>
                    <li><a href="/login"><i class="fa fa-sign-in"></i></a></li>
                    <li><a href="/signup"><i class="fa fa-user-plus"></i></a></li>
                <? endif; ?>
            </ul>
        </div>
    </div>
</nav>
