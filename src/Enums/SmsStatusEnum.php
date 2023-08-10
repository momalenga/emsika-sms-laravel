<?php
namespace Shengamo\LaravelEmsikaSms\Enums;

enum SmsStatusEnum: string
{
    case UNSENT = 'Unsent';
    case SENT = 'Sent';
    case DRAFT = 'Draft';
    case FAILED = 'Failed';
    case DELIVERED = 'Delivered';
}
