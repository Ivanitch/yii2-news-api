<?php

namespace core\helpers;

use core\entities\News\News;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class NewsHelper
{
    public static function statusList(): array
    {
        return [
            News::STATUS_DRAFT => 'Draft',
            News::STATUS_ACTIVE => 'Active',
        ];
    }

    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    public static function statusLabel($status): string
    {
        switch ($status) {
            case News::STATUS_DRAFT:
                $class = 'label label-default';
                break;
            case News::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }
}