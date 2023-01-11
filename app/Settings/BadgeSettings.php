<?php

namespace app\Settings;

use Spatie\LaravelSettings\Settings;

class BadgeSettings extends Settings
{
    public string $qr_link;
    public array $svg_front;
    public string $exp_date;
    public array $svg_back;
    public bool $is_redirect;

    public static function group(): string
    {
        return 'Badges';
    }
}