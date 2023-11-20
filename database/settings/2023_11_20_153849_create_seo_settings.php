<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('seo.meta_keyword', '');
        $this->migrator->add('seo.meta_title', '');
        $this->migrator->add('seo.meta_description', '');
        $this->migrator->add('seo.og_title', '');
        $this->migrator->add('seo.og_description', '');
        $this->migrator->add('seo.twitter_title', '');
        $this->migrator->add('seo.twitter_description', '');
    }
};
