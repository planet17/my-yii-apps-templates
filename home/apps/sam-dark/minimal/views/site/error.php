<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
use yii\helpers\Html;
$this->title = $name;
?>
<style> .site-error > h1, .site-error > div { margin: 0 auto; display: block; width: 500px; } </style>
<div class="site-error">
    <h1><?= Html::encode($this->title) ?></h1>
    <div>
        <?= nl2br(Html::encode($message)) ?>
    </div>
    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>
</div>
