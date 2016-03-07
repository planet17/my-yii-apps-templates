<?php
$CSRFParam = Yii::$app->request->csrfParam;
$CSRFToken = Yii::$app->request->csrfToken;

use yii\helpers\Html;
use yii\widgets\Menu;

/* @var $this \yii\web\View */
/* @var $content string */
\yii\web\YiiAsset::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language; ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo Html::csrfMetaTags(); ?>
    <title><?php echo Html::encode($this->title); ?></title>
    <link rel="stylesheet" href="<?php echo Yii::$app->request->getBaseUrl(); ?>/css/site.css"/>
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>
    <div class="header">
        <h1><?php echo Html::a('My company', ['/site/index']); ?></h1>
    <?php echo Menu::widget([
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                [
                    'url' => ['/site/logout'],
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'template' => <<<HTML
<form method="post" action="{url}">
<input type="hidden" name="{$CSRFParam}" value="{$CSRFToken}" />
<input type="submit" value="{label}" />
</form>
HTML
,
                ]
            ),
        ]
    ]); ?>
    </div>

    <div class="content">
        <?php echo $content; ?>
    </div>

    <footer class="footer">
        <?php
        $durationYears = (date('Y') > 2016) ? '2016-' . date('Y') : '2016';
        echo('&copy; Site SSU by Planet17 ' . $durationYears . ', ' . Yii::powered());
        unset($durationYears);
        ?>
    </footer>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>