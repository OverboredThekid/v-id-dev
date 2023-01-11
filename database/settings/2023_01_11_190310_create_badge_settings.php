<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateBadgeSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.qr_link', 'Https://Generationsav.com/stafflinks');
        $this->migrator->add('general.exp_date', '01/01/2023');
        $this->migrator->add('general.svg_front', '1');
        $this->migrator->add('general.svg_back', '2');
        $this->migrator->add('general.is_redirect', true);
    }
}
