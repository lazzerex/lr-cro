<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Giải pháp CRO');
        $this->migrator->add('general.test_array', []);
        $this->migrator->add('general.test_json', '');
    }
};
