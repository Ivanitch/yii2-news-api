<?php
namespace frontend\controllers\auth;

use core\services\auth\SignupService;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use core\forms\auth\SignupForm;
use yii\web\HttpException;

class SignupController extends Controller
{
    private $service;

    public function __construct($id, $module, SignupService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionRequest()
    {
        $form = new SignupForm();

        if ($form->load(Yii::$app->request->post())
            && $form->validate()
            && Yii::$app->request->post()["SignupForm"]["check"] === 'nospam')

        {
            try {
                $this->service->signup($form);
                Yii::$app->session->setFlash('success', 'Проверьте электронную почту для получения дальнейших инструкций. Письмо может попасть в "Спам".');
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('request', [
            'model' => $form,
        ]);
    }



    /**
     * @param $token
     * @return mixed
     */
    public function actionConfirm($token)
    {
        try {
            $this->service->confirm($token);
            Yii::$app->session->setFlash('success', 'Ваш Email подтверждён.');
            return $this->redirect(['auth/auth/login']);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->goHome();
    }
}
