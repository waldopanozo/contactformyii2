<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Contact */

use app\models\Contact;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\web\JqueryAsset;

$this->title = 'Contact Us';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['id' => 'contact-form','enableClientValidation'=>false]); ?>
<div id="main">
    <div class="title">
        <h1>Contact Us</h1>
    </div>

    <div class="left">

        <div class="field">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="field">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="field">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="right">
        <div class="field">
            <?= $form->field($model, 'message')->textarea(['maxlength' => true, 'rows' => 3, 'cols' => 30]) ?>
        </div>
        <div class="field submit">
            <input type="submit" id="send" value="Submit"/>
        </div>
    </div>
</div>
<?php ActiveForm::end();


    $this->registerJsFile("/js/index.js", ['depends' => [JqueryAsset::className()]]);

?>
