<?php 
/** @var yii\web\View $this */
/** @var common\models\Product $model */
?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title"></h3>
            <h6 class="card-subtitle"><?php echo $model->name?></h6>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-6">
                    <div class="white-box text-center"><img src="<?php echo $model->getImageLink()?>" class="img-responsive me-5"></div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-6 bg-light rounded">
                    <h4 class="box-title mt-5">Product description</h4>
                    <p><?php echo $model->body?></p>
                    <h2 class="mt-5">
                    <?php echo $model->price?>
                    </h2>
                    <button class="btn btn-dark btn-rounded mr-1" data-toggle="tooltip" title="" data-original-title="Add to cart">
                        <i class="fa fa-shopping-cart"></i>
                    </button>
                    <button class="btn btn-primary btn-rounded">Buy Now</button>
                   
                </div>
               
            </div>
        </div>
    </div>
</div>