<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateBadgeSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('Badges.qr_link', 'Https://Generationsav.com/stafflinks');
        $this->migrator->add('Badges.svg_front', 'svg/FRONT.svg');
        $this->migrator->add('Badges.svg_back', 'svg/BACK.svg');
        $this->migrator->add('Badges.site_logo', 'site_logo/site_logo.png');
        $this->migrator->add('Badges.site_logo_big', 'site_logo_big/site_logo_big.png');
        $this->migrator->add('Badges.is_redirect', true);
    }
}
