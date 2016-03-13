<?php /** User: planet17 Date: 05.03.16 Time: 19:19 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use planet17\ssi\assets\InAsset;

InAsset::register($this);
/* @var $model planet17\ssu\models\Auth\Forms\Up */
/* @var $form ActiveForm */

$textAction = 'Sign In';
$this->title = $textAction;
?>
<h1><?php echo $textAction; ?></h1>
<hr>

<div class="main-reg">
    <?php $form = ActiveForm::begin([
        'method' => 'post', 'action' => ['/'],
        'options' => ['id' => 'signUP', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => ['template' => "\n{input}\n{error}\n", 'labelOptions' => []],
        'enableAjaxValidation' => false
    ]);

    echo($form->field($model, 'email', [])
        ->input('email',
            [
                'placeholder' => $model->attributeLabels()['email'],
                'autofocus' => true
            ]
        ));

    echo($form->field($model, 'password')
        ->passwordInput(['placeholder' => $model->attributeLabels()['password']]));
    ?>
    <?= $form->field($model, 'rememberMe')->checkbox() ?>
    <div class="form-group">
        <?php echo Html::submitButton('Sign In', ['class' => 'btn btn-primary']); ?>
    </div>
    <?php ActiveForm::end(); ?>

    <?= Html::a('Забыли пароль?', ['/main/send-email']) ?>
</div>