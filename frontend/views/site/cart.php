<div class="container pb-5 mt-n2 mt-md-n3">
    <div class="row">
        <div class="col-xl-9 col-md-8">
            <h2 class="h6 d-flex flex-wrap justify-content-between align-items-center px-4 py-3 bg-secondary">
                <span>Products</span>
                <a class="font-size-sm" href="<?php echo Yii::$app->params['frontendUrl']?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left" style="width: 1rem; height: 1rem;">
                            <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>Continue shopping
                </a>
            </h2>
            <?php foreach ($cart as $product) { ?>
                <!-- Item-->
                <div class="d-sm-flex justify-content-between my-4 pb-4 border-bottom">
                    <div class="media d-block d-sm-flex text-center text-sm-left">
                        <a class="cart-item-thumb mx-auto mr-sm-4" href="#"><img src="<?php echo $product['image_link'] ?? "" ?>" alt="Product"></a>
                        <div class="media-body pt-3">
                            <h3 class="product-card-title font-weight-semibold border-0 pb-0"><a href="#"><?php echo $product['name'] ?></a></h3>
                            <div class="font-size-lg text-primary pt-2"><?php echo $product['price'] ?>$</div>
                        </div>
                    </div>
                    <div class="pt-2 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-left" style="max-width: 10rem;">
                        <div class="form-group mb-2">
                            <form action="<?php echo Yii::$app->params['frontendUrl'] . 'site/addcart' ?>">
                                <label for="quantity1">Quantity</label>
                                <input class="form-control form-control-sm" name="quantity" type="number" id="quantity1" value="<?php echo $product['quantity'] ?>">
                                <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                        </div>
                        <button class="btn btn-outline-secondary btn-sm btn-block mb-2" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw mr-1">
                                <polyline points="23 4 23 10 17 10"></polyline>
                                <polyline points="1 20 1 14 7 14"></polyline>
                                <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                            </svg>Update cart</button>
                        </form>


                        <button class="btn btn-outline btn-block btn-sm"><a href="/site/reset-cart?id=<?php echo $product['id'] ?>">reset</a></button>
                    </div>
                </div>
            <?php  } ?>
        </div>
        <!-- Sidebar-->
        <div class="col-xl-3 col-md-4 pt-3 pt-md-0">
            <h2 class="h6 px-4 py-3 bg-secondary text-center">Subtotal</h2>
            <div class="h3 font-weight-semibold text-center py-3"><?php echo $total ?>$</div>
            <hr>

        </div>
    </div>
</div>