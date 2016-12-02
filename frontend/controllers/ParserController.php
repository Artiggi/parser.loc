<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\XmlUpload;
use frontend\models\Product;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class ParserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
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
        $model = new XmlUpload();

        if (Yii::$app->request->isPost) {
            $model->xmlFile = UploadedFile::getInstance($model, 'xmlFile');

            if ($model->upload()) {

                Yii::$app->session->setFlash('upl-status', 'File uploaded');
                $data = $model->getdata();
                $productPrev = null;
                foreach ($data->products[0] as $child) {

                    $productModel = new Product();

                    foreach ($child->children() as $product => $value) {

                        if ($product == 'product_id') {
                            if ((int)$value){
                                $productModel->product_id = (int)$value;
                                $productPrev = (int)$value;
                            }
                            else{
                                $productModel->product_id = $productPrev;
                            }
                        }
                        if ($product == 'title') {
                            $productModel->title = (string)$value;
                        }
                        if ($product == 'description') {
                            $productModel->description = (string)$value;
                        }
                        if ($product == 'rating') {
                            $productModel->rating = (float)$value;
                        }

                        if ($product == 'inet_price') {
                            $productModel->price = (double)$value;
                        }
                        elseif ($product == 'price') {
                            $productModel->price = (double)$value;
                        }

                        if ($product == 'image') {
                            $productModel->image = (string)$value;
                        }
                    }

                    if ($productModel->validate() && $productModel->save()){
                        Yii::$app->session->setFlash('pars-status', 'File import success');
                    } else
                    {
                        Yii::$app->session->setFlash('pars-status', 'File import fail');
                        print_r($productModel->errors);
                    }

                }

                    return $this->render('view', [
                        'model' => $model,
                        'data' => $data,
                    ]);
            }

            else {
                Yii::$app->session->setFlash('upl-status', 'File not uploaded');
                return $this->render('index', ['model' => $model]);
            }
        }
        return $this->render('index', ['model' => $model]);
    }
}
