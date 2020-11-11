<?php
namespace frontend\controllers;

use frontend\components\CustomMailer;
use Yii;
use yii\web\Controller;

class ErrorController extends Controller
{
    private $mailer;

    public function __construct($id, $module, CustomMailer $mailer, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->mailer = $mailer;
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            $statusCode = $exception->statusCode;
            $name = $exception->getName();
            $message = $exception->getMessage();
            $string   = 'Failed';
            $pos = strpos($message, $string);
            if ($pos !== false) {
                $this->mailer->sending('error/server-internal', 'Internal Server Error на сайте ');
            }
            // error/error
            return $this->render('error', [
                'exception' => $exception,
                'statusCode' => $statusCode,
                'name' => $name,
                'message' => $message
            ]);
        }
        return false;
    }
}