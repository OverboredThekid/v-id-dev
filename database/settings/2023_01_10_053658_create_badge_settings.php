<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateBadgeSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('badges.qrcode_link', 'https://generationsav.com/stafflinks');
        $this->migrator->add('general.exp_date', '01/01/23');
        $this->migrator->add('general.is_redirect', True);
    }
}
