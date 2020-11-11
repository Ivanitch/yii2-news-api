<?php

namespace frontend\components;

use yii\mail\MailerInterface;

class CustomMailer
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sending($tempale, $message): void
    {
        $sent = $this->mailer
          ->compose(['html' => $tempale.'-html', 'text' => $tempale.'-text'])
          ->setTo(\Yii::$app->params['adminEmail'])
          ->setSubject($message . \Yii::$app->name)
          ->send();
        if (!$sent) {
            throw new \RuntimeException('Email sending error.');
        }
    }
}