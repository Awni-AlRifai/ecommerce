<?php


/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'My Yii Application';
?>
   
<div class="site-index">
  <div class="p-1 mb-1 bg-transparent rounded-3">
    <div class="container-fluid py-5 text-center">
      <h1 class="display-4">Welcome!</h1>
      <p class="fs-5 fw-light">You can view our products here.</p>
    </div>
  </div>

  <div class="body-content">
    <div class="container d-flex w-100 justify-content-center mt-50 mb-50">
      <div class="row">
      <?php foreach($dataProvider->getModels() as $model){?>
        <div class="col-md-4 mt-2">
          <div class="card">
            <div class="card-body">
              <div class="card-img-actions">
                <img
                  src="<?php echo $model->getImageLink()?>"
                  class="card-img img-fluid"
                  width="96"
                  height="350"
                  alt=""
                />
              </div>
            </div>

            <div class="card-body bg-light text-center">
              <div class="mb-2">
                <h6 class="font-weight-semibold mb-2">
                  <a href="<?php echo "/{$model->id}"?>" class="text-default mb-2" data-abc="true"
                    ><?php echo $model->name?></a
                  >
                </h6>

                <span href="#" class="text-muted" data-abc="true"
                  ><?php echo $model->category->name?></span
                >
              </div>

              <h3 class="mb-0 font-weight-semibold"><?php echo $model->price?>$</h3>

              <button type="button" class="btn bg-cart">
                <i class="fa fa-cart-plus mr-2"></i> Add to cart
              </button>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
