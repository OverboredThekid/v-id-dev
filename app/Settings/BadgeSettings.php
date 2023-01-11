<?php

namespace app\Settings;

use Spatie\LaravelSettings\Settings;

class BadgeSettings extends Settings
{
    public string $qr_link;
    public object $svg_front;
    public string $exp_date;
    public object $svg_back;
    public bool $is_redirect;

    public static function group(): string
    {
        return 'Badges';
    }
}