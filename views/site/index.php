<?php
/* @var $this yii\web\View */
use app\helpers\QueryHelper;
$this->title = 'My Yii Application';

?>

<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome!</h1>

        <p><a class="btn btn-lg btn-success" href="<?=  QueryHelper::createQuery('authorize') ?>">Log in</a></p>
    </div>

</div>
