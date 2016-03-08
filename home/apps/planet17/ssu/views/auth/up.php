<?php /** User: planet17 Date: 05.03.16 Time: 19:19 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model planet17\ssu\models\Auth\Forms\Up */
/* @var $form ActiveForm */

$this->title = 'Want to be registered?'; ?>
<h1>Sign up on the site with registration</h1>
<h2>Want to be registered?</h2>
<p>All you need to do - is sign up!</p>
<hr>

<div class="main-reg">
    <?php $form = ActiveForm::begin([
        'method' => 'post', 'action' => ['/'],
        'options' => ['id' => 'signUP', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => ['template' => "\n{input}\n{error}\n", 'labelOptions' => []]
    ]);

    echo($form->field($model, 'email', ['enableAjaxValidation' => true])
        ->input('email', ['placeholder' => $model->attributeLabels()['email']]));
    echo($form->field($model, 'password')
        ->passwordInput(['placeholder' => $model->attributeLabels()['password']]));
    ?>
    <div class="form-group">
        <?php echo Html::submitButton('Sign Up', ['class' => 'btn btn-primary']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>