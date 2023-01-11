<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class BadgeSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('Badge.qr_link', 'Https://generationsav.com/stafflinks');
        $this->migrator->add('Badge.exp_date','01/01/2023');
        $this->migrator->add('Badge.svg_file', null);
        $this->migrator->add('Badge.is_redirect', true);
    }
}
