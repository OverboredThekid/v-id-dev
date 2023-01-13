<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateBadgeSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('Badges.qr_link', 'Https://Generationsav.com/stafflinks');
        $this->migrator->add('Badges.exp_date', '01/01/2023');
        $this->migrator->add('Badges.svg_front', 'Select Front SVG File');
        $this->migrator->add('Badges.svg_back', 'Select Back SVG File');
        $this->migrator->add('Badges.qr_logo', 'Select QR Code Logo');
        $this->migrator->add('Badges.is_redirect', true);
    }
}
