<?php

namespace frontend\common;

use Yii;

class Cart
{
    /**
     * Add  a product to the cart
     * @param int $id product ID
     * @param \common\models\query\ProductQuery|array $product the active query used by this AR class.
     * @param int $quantity
     * 
     */
    public function addCart($id, $product, $quantity)
    {
        $session = Yii::$app->session;

        if (!isset($session['cart'])) {
            $cart[$id] = [
                ...$product,
                'quantity' => (int)$quantity,
                'image_link' => $product->getImageLink(),
            ];
        } else {
            $cart = $session['cart'];
            if (array_key_exists($id, $cart)) {
                $cart[$id]['quantity'] = $cart[$id]['quantity'] + $quantity;
            } else {
                $cart[$id] = [
                    ...$product,
                    'quantity' => (int) $quantity,
                    'image_link' => $product->getImageLink(),
                ];
            }
        }
        return $cart;
    }

    /**
     * Find the total price of the products in the cart
     * @param array $cart
     * 
     * @return int $total
     */
    public function findTotalAmount($cart)
    {
        $total = 0;

        foreach ($cart as $product) {
            $total += $product['quantity'] * $product['price'];
        }

        return $total;
    }

    /**
     * Reset the quantity of a certain product in the cart to 1
     * @param int $id product id
     */
    public function resetProductQuantity($id)
    {
        $session = Yii::$app->session;

        if (isset($session['cart'])) {
            $cart = $session['cart'];
            $cart[$id]  = [
                ...$cart[$id],
                'quantity' => 1,
            ];

            Yii::$app->session['cart'] = $cart;
        }
    }
}
