<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Giải pháp CRO');
        $this->migrator->add('general.site_email', 'admin@example.com');
        $this->migrator->add('general.site_logo', '');
        $this->migrator->add('general.site_icon', '');
    }
};
