<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateBadgeSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('Badges.qr_link', 'Https://Generationsav.com/stafflinks');
        $this->migrator->add('Badges.exp_date', '01/01/2023');
        $this->migrator->add('Badges.svg_front', '1');
        $this->migrator->add('Badges.svg_back', '2');
        $this->migrator->add('Badges.is_redirect', true);
    }
}
