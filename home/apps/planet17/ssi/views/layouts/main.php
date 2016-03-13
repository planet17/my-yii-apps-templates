<?php
use yii\helpers\Html;
use yii\widgets\Menu;

/* @var $this \yii\web\View */
/* @var $content string */
/* @var Yii::$app->user->identity \planet17\ssu\models\Auth\Models\User */
\yii\web\YiiAsset::register($this);
$CSRFParam = Yii::$app->request->csrfParam;
$CSRFToken = Yii::$app->request->csrfToken;
$formTemplate =
    '<form method="post" action="{url}">' .
    '<input type="hidden" name="' . $CSRFParam .'" value="' . $CSRFToken . '" />' .
    '<input type="submit" value="{label}" />' .
    '</form>';

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language; ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo Html::csrfMetaTags(); ?>
    <title><?php echo Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>
    <div class="header">
        <h1><?php echo Html::a('Logotype', ['/']); ?></h1>
    <?php
    if (!Yii::$app->user->isGuest) {
        echo Menu::widget([
            'items' => [
                [
                    'url' => ['/auth/logout'],
                    'label' => 'Logout',
                    'template' => $formTemplate
                ],
            ]
        ]);
    }
    unset($formTemplate);
     ?>
    </div>

    <div class="content">
        <?php echo $content; unset($content); ?>
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