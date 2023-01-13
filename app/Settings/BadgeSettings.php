<?php

namespace app\Settings;

use Spatie\LaravelSettings\Settings;

class BadgeSettings extends Settings
{
    public string $qr_link;
    public string $svg_front;
    public string $qr_logo;
    public string $exp_date;
    public string $svg_back;
    public bool $is_redirect;

    public static function group(): string
    {
        return 'Badges';
    }
}