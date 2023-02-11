<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class svgIdsSave extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('svgIdSave.db_staff_img', 'staff_img');
        $this->migrator->add('svgIdSave.db_first_name', 'first_name');
        $this->migrator->add('svgIdSave.db_last_name', 'last_name');
        $this->migrator->add('svgIdSave.db_exp_date', 'exp_date');
        $this->migrator->add('svgIdSave.db_staff_position', 'staff_position');
        $this->migrator->add('svgIdSave.db_qr_code', 'qr_code');
        $this->migrator->add('svgIdSave.db_phone', 'phone');
        $this->migrator->add('svgIdSave.db_site_logo', 'site_logo');
        $this->migrator->add('svgIdSave.db_site_logo_big', 'site_logo_big');
    }
}
