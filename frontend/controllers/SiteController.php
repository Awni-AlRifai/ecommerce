<?php

namespace frontend\controllers;
use Yii;
use yii\data\ActiveDataProvider;
use common\models\Product;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\common\Cart;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                    
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Product::find()
                ->where(['id' => $id])
                ->one(),
        ]);
    }

    public function actionCart()
    {
        $cart = new Cart();
        $cartItems = Yii::$app->session['cart'];
        $total = $cart->findTotalAmount($cartItems);

        return $this->render('cart', ['cart' => $cartItems, 'total' => $total]);
    }

    public function actionAddcart($id,$quantity)
    {
       
        $product = Product::find()
                    ->where(['id' => $id])
                    ->one();
        
        $cart = new Cart();

        $modified_cart = $cart->addCart($id,$product,$quantity); 
        Yii::$app->session['cart'] = $modified_cart;
          
        return $this->actionCart();
    }

    public function actionResetCart($id){
        $cart = new Cart();
        $cart->resetProductQuantity($id);
        return $this->actionCart();

    }
}
