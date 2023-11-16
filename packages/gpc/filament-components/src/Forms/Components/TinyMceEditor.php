<?php

/**
 * Tham khảo:
 * https://github.com/mohamedsabil83/filament-forms-tinyeditor
 * https://github.com/amidesfahani/filament-tinyeditor
 */

namespace Gpc\FilamentComponents\Forms\Components;

use Filament\Forms\Components\Concerns;
use Filament\Forms\Components\Contracts;
use Filament\Forms\Components\Field;
use Illuminate\Support\Str;

class TinyMceEditor extends Field implements Contracts\CanBeLengthConstrained, Contracts\HasFileAttachments
{
	use Concerns\CanBeLengthConstrained;
    use Concerns\HasFileAttachments;
    use Concerns\HasPlaceholder;

	protected string $view = 'gpc-filament-components::forms.components.tiny-mce-editor';

    protected string $profile = 'default';
    protected bool $isSimple = false;

    protected int $maxHeight = 0;
    protected int $minHeight = 0;

	protected string $toolbar;
    protected bool $toolbarSticky = true;
    protected bool $showMenuBar = false;

    protected array $externalPlugins;

    protected string $templates = '';

    protected string|\Closure $language;

    protected string $filePickerUrl = '';

    protected function setUp(): void
    {
        parent::setUp();

        $this->language = app()->getLocale();
    }

    public function getToolbar(): string
    {
        $toolbar = 'undo redo removeformat | blocks | bold italic forecolor backcolor | numlist bullist outdent indent | table | image link anchor emoticons | code';

        if ($this->isSimple()) {
            $toolbar = 'removeformat | blocks bold italic forecolor | image link emoticons';
        }

        if (config('gpc-filament-components.tinymce.profiles.'.$this->profile.'.toolbar')) {
            $toolbar = config('gpc-filament-components.tinymce.profiles.'.$this->profile.'.toolbar');
        }

        return $toolbar;
    }

    public function getPlugins(): string
    {
        $plugins = 'autoresize advlist autolink link image lists charmap preview anchor searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media table emoticons help';

        if ($this->isSimple()) {
            $plugins = 'autoresize image emoticons link wordcount';
        }

        if (config('gpc-filament-components.tinymce.profiles.'.$this->profile.'.plugins')) {
            $plugins = config('gpc-filament-components.tinymce.profiles.'.$this->profile.'.plugins');
        }

        return $plugins;
    }

    public function isSimple(): bool
    {
        return (bool) $this->evaluate($this->isSimple);
    }

    public function getFileAttachmentsDirectory(): ?string
    {
        $directory = $this->evaluate($this->fileAttachmentsDirectory);

        if (filled($directory)) {
            return $directory;
        }

        return config('gpc-filament-components.tinymce.profiles.'.$this->profile.'.upload_directory');
    }

    public function templates(string $templates): static
    {
        $this->templates = addslashes($templates);

        return $this;
    }

    public function getTemplates(): string
    {
        return $this->templates;
    }

    public function language(string|\Closure $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getInterfaceLanguage(): string
    {
        return match ($this->evaluate($this->language)) {
            'ar' => 'ar',
            'az' => 'az',
            'bg' => 'bg_BG',
            'bn' => 'bn_BD',
            'ca' => 'ca',
            'cs' => 'cs',
            'cy' => 'cy',
            'da' => 'da',
            'de' => 'de',
            'dv' => 'dv',
            'el' => 'el',
            'eo' => 'eo',
            'es' => 'es',
            'et' => 'et',
            'eu' => 'eu',
            'fa' => 'fa',
            'fi' => 'fi',
            'fr' => 'fr_FR',
            'ga' => 'ga',
            'gl' => 'gl',
            'he' => 'he_IL',
            'hr' => 'hr',
            'hu' => 'hu_HU',
            'hy' => 'hy',
            'id' => 'id',
            'is' => 'is_IS',
            'it' => 'it',
            'ja' => 'ja',
            'kab' => 'kab',
            'kk' => 'kk',
            'ko' => 'ko_KR',
            'ku' => 'ku',
            'lt' => 'lt',
            'lv' => 'lv',
            'nb' => 'nb_NO',
            'nl' => 'nl',
            'oc' => 'oc',
            'pl' => 'pl',
            'pt' => 'pt_BR',
            'ro' => 'ro',
            'ru' => 'ru',
            'sk' => 'sk',
            'sl' => 'sl',
            'sq' => 'sq',
            'sr' => 'sr',
            'sv' => 'sv_SE',
            'ta' => 'ta',
            'tg' => 'tg',
            'th' => 'th_TH',
            'tr' => 'tr',
            'ug' => 'ug',
            'uk' => 'uk',
            'vi' => 'vi',
            'zh' => 'zh_CN',
            default => 'en',
        };
    }

    public function getLanguageId(): string
    {
        return match ($this->getInterfaceLanguage()) {
            'ar' => 'tinymce-lang-ar',
            'az' => 'tinymce-lang-az',
            'bg' => 'tinymce-lang-bg_BG',
            'bn' => 'tinymce-lang-bn_BD',
            'ca' => 'tinymce-lang-ca',
            'cs' => 'tinymce-lang-cs',
            'cy' => 'tinymce-lang-cy',
            'da' => 'tinymce-lang-da',
            'de' => 'tinymce-lang-de',
            'dv' => 'tinymce-lang-dv',
            'el' => 'tinymce-lang-el',
            'eo' => 'tinymce-lang-eo',
            'es' => 'tinymce-lang-es',
            'et' => 'tinymce-lang-et',
            'eu' => 'tinymce-lang-eu',
            'fa' => 'tinymce-lang-fa',
            'fi' => 'tinymce-lang-fi',
            'fr' => 'tinymce-lang-fr_FR',
            'ga' => 'tinymce-lang-ga',
            'gl' => 'tinymce-lang-gl',
            'he' => 'tinymce-lang-he_IL',
            'hr' => 'tinymce-lang-hr',
            'hu' => 'tinymce-lang-hu_HU',
            'hy' => 'tinymce-lang-hy',
            'id' => 'tinymce-lang-id',
            'is' => 'tinymce-lang-is_IS',
            'it' => 'tinymce-lang-it',
            'ja' => 'tinymce-lang-ja',
            'kab' => 'tinymce-lang-kab',
            'kk' => 'tinymce-lang-kk',
            'ko' => 'tinymce-lang-ko_KR',
            'ku' => 'tinymce-lang-ku',
            'lt' => 'tinymce-lang-lt',
            'lv' => 'tinymce-lang-lv',
            'nb' => 'tinymce-lang-nb_NO',
            'nl' => 'tinymce-lang-nl',
            'oc' => 'tinymce-lang-oc',
            'pl' => 'tinymce-lang-pl',
            'pt' => 'tinymce-lang-pt_BR',
            'ro' => 'tinymce-lang-ro',
            'ru' => 'tinymce-lang-ru',
            'sk' => 'tinymce-lang-sk',
            'sl' => 'tinymce-lang-sl',
            'sq' => 'tinymce-lang-sq',
            'sr' => 'tinymce-lang-sr',
            'sv' => 'tinymce-lang-sv_SE',
            'ta' => 'tinymce-lang-ta',
            'tg' => 'tinymce-lang-tg',
            'th' => 'tinymce-lang-th_TH',
            'tr' => 'tinymce-lang-tr',
            'ug' => 'tinymce-lang-ug',
            'uk' => 'tinymce-lang-uk',
            'vi' => 'tinymce-lang-vi',
            'zh' => 'tinymce-lang-zh_CN',
            default => 'tinymce',
        };
    }

    public function profile(string $profile): static
    {
        $this->profile = $profile;

        return $this;
    }

    public function getCustomConfigs(): string
    {
        if (config('gpc-filament-components.tinymce.profiles.'.$this->profile.'.custom_configs')) {
            return '...'.json_encode(config('gpc-filament-components.tinymce.profiles.'.$this->profile.'.custom_configs'));
        }

        return '';
    }

	public function getMaxHeight(): int
	{
		return $this->maxHeight > 0 ? $this->maxHeight : config('gpc-filament-components.tinymce.maxHeight');
	}

    public function maxHeight(int $maxHeight): static
    {
        $this->maxHeight = $maxHeight;

        return $this;
    }

	public function getMinHeight(): int
	{
        return $this->minHeight > 0 ? $this->minHeight : config('gpc-filament-components.tinymce.minHeight');
	}

    public function minHeight(int $minHeight): static
    {
        $this->minHeight = $minHeight;

        return $this;
    }

	public function getToolbarSticky(): bool
    {
        return $this->toolbarSticky;
    }

	public function toolbarSticky(bool $toolbarSticky): static
    {
        $this->toolbarSticky = $toolbarSticky;

        return $this;
    }

    public function getShowMenuBar(): bool
    {
        return $this->showMenuBar;
    }

	public function showMenuBar(): static
    {
        $this->showMenuBar = true;

        return $this;
    }

    public function getExternalPlugins(): array
    {
        return $this->externalPlugins ?? [];
    }

    public function setExternalPlugins(array $plugins): static
    {
        $this->externalPlugins = $plugins;

        return $this;
    }

    public function getFilePickerUrl(): string
    {
        return filled($this->filePickerUrl) ? $this->filePickerUrl : config('gpc-filament-components.file-manager.tinymce-url');
    }
}
