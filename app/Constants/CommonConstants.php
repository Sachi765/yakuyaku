<?php

namespace App\Constants;

class CommonConstants
{
    // ユーザー役割
    public const ROLE_USER = 1;
    public const ROLE_ADMIN = 2;

    // ステータス
    public const STATUS_NONE = '0';
    public const STATUS_RECEIVED = '1';
    public const STATUS_IN_PROGRESS = '2';
    public const STATUS_COMPLETED = '9';

    // プッシュ通知
    public const PUSH_NOTIFICATION_ENABLED = 1;
    public const PUSH_NOTIFICATION_DISABLED = 0;

    // 待機時間（分）
    public const WAITING_TIME_MINUTES = 15;

    //　予約番号
    public const RESERVATION_NUMBER_MIN = 1000;
    public const RESERVATION_NUMBER_MAX = 9999;

}