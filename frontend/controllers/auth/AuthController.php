<?php
namespace frontend\controllers\auth;

use core\services\auth\AuthService;
use Yii;
use yii\web\Controller;
use core\forms\auth\LoginForm;

class AuthController extends Controller
{
    private $service;

    public function __construct($id, $module, AuthService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post())
            && $form->validate()
            && Yii::$app->request->post()["LoginForm"]["check"] === 'nospam')

        {
            try {
                $user = $this->service->auth($form);
                Yii::$app->user->login($user, $form->rememberMe ? Yii::$app->params['user.rememberMeDuration'] : 0);
                Yii::$app->session->setFlash('success', 'Вы успешно вошли на сайт!');
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('login', [
            'model' => $form,
        ]);
    }

    /**
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goBack((
            !empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null
        ));
    }
}
