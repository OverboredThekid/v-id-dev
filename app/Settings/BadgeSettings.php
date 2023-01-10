<?php
use Spatie\LaravelSettings\Settings;

class BadgeSetting extends Settings
{
    public string $qrcode_link;
    
    public string $exp_date;

    public bool $is_redirect;
    
    public static function group(): string
    {
        return 'badges';
    }
}