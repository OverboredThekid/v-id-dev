<?php

namespace app\Settings;

use Spatie\LaravelSettings\Settings;

class BadgeSettings extends Settings
{
    public string $qr_link;

    public string $exp_date;

    public object $svg_file_front;

    public object $svg_file_back;
    
    public bool $is_redirect;
    
    public static function group(): string
    {
        return 'Badge';
    }
}