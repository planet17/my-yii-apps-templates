<?php /** User: planet17 Date: 13.03.16 Time: 22:11 */

use yii\widgets\ActiveForm;
use planet17\ssi\assets\InAsset;

InAsset::register($this);
/* @var $model planet17\ssu\models\Auth\Forms\Up */
/* @var $form ActiveForm */

$textAction = 'Hello';
$this->title = $textAction;
?>
<h1><?php echo $textAction; ?></h1>