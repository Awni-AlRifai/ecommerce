<?php

/** @var yii\web\View $this */
/** @var common\models\Product $model */
?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title"></h3>
            <h6 class="card-subtitle"><?php echo $model->name ?></h6>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-6">
                    <div class="white-box text-center"><img src="<?php echo $model->getImageLink() ?>" class="img-responsive me-5"></div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-6 bg-light rounded">
                    <h4 class="box-title mt-5">Product description</h4>
                    <p><?php echo $model->body ?></p>
                    <h2 class="mt-5">
                        <?php echo $model->price ?>
                    </h2>
                    <!-- Change the `data-field` of buttons and `name` of input field's for multiple plus minus buttons-->
                    <form action="addcart" method="get">
                    <div class="input-group plus-minus-input">
                        <div class="input-group-button">
                            <button type="button" class="button hollow circle" data-quantity="minus" data-field="quantity">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </button>
                        </div>
                        <input class="input-group-field" type="number" name="quantity" value="1" min="1" max="10">
                        <input class="input-group-field" type="hidden" value="<?php echo $model->id ?>" name="id">
                        <div class="input-group-button">
                            <button type="button" class="button hollow circle" data-quantity="plus" data-field="quantity">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">add to cart</button>
                    </form>




                </div>

            </div>
        </div>
    </div>
</div>