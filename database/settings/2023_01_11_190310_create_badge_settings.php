<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateBadgeSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('Badges.qr_link', 'Https://Generationsav.com/stafflinks');
        $this->migrator->add('Badges.svg_front', 'svg/FRONT.svg');
        $this->migrator->add('Badges.svg_back', 'svg/BACK.svg');
        $this->migrator->add('Badges.qr_logo', 'qr_logo/logo.png');
        $this->migrator->add('Badges.is_redirect', true);
    }
}
