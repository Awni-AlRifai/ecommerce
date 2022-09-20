<?php

namespace frontend\common;

use Yii;

class Cart
{



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
            if(array_key_exists($id,$cart)){
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

    public function findTotalAmount($cart)
    {
        $total = 0;

        foreach($cart as $product){
            $total += $product['quantity'] * $product['price'];
        }
        
        return $total;
    }

    public function resetProductQuantity($id){
        $session = Yii::$app->session;
        if(isset($session['cart'])){
            $cart = $session['cart'];
            $cart[$id]  = [
                 ...$cart[$id],
                  'quantity' => 1,
            ];
            
            Yii::$app->session['cart'] = $cart;
        }
    }
}
