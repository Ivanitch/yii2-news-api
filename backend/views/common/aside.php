<?php
$contextID = $this->context->id;
$filesUrl = 'file';
$pagesUrl = 'page';
$usersUrl = 'user';
?>
<div class="side-menu">
    <nav class="navbar navbar-default" role="navigation">
        <div class="side-menu-container">
            <ul class="nav navbar-nav">
                <li class="<?= $contextID == $filesUrl ? 'active' : '' ?>"><a href="/file"><i class="fa fa-file-text-o"></i> Файлы</a></li>
                <li class="<?= $contextID == $pagesUrl ? 'active' : '' ?>"><a href="/page"><i class="fa fa-file"></i> Страницы</a></li>
                <li class="<?= $contextID == $usersUrl ? 'active' : '' ?>">
                    <a href="/user"><i class="fa fa-users"></i> Пользователи</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
