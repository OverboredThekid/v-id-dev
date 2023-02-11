<?php

namespace app\Settings;

use Spatie\LaravelSettings\Settings;

class svgIdsSave extends Settings
{
    public string $db_staff_img;
    public string $db_first_name;
    public string $db_last_name;
    public string $db_exp_date;
    public string $db_staff_position;
    public string $db_qr_code;
    public string $db_phone;
    public string $db_site_logo;
    public string $db_site_logo_big;

    public static function group(): string
    {
        return 'svgIdSave';
    }
}