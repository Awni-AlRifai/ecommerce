<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php echo $form->errorSummary($model) ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map($categories, 'id', 'name'),
        ['prompt' => 'Select Category']
    ) ?>
    <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>
    <div class="d-block w-50 m-auto d-flex flex-column gap-1 align-items-center">
        <div class="upload-icon">
            <i class="fas fa-upload"></i>
        </div>
        <br>

        <p class="m-0">Drag and drop a file you want to upload
        <p>

            <button id="select-file-btn" class="btn btn-primary btn-file mx-auto mb-3">
                Select File
                <input type="file" id="imageFile" name="image"  onchange="loadFile(event)">
            </button>

            <img id="image-preview" class=" border" />

    </div>
   
    <div class="form-group ms-auto w-25">
        <?= Html::submitButton('Save', ['class' => 'btn d-block btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>