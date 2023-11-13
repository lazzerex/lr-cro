<?php

namespace App\Filament\Tables\Columns;

use Closure;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Layout\Component;
use Filament\Tables\Columns\Layout\View;

class StackableColumn extends Column
{
    protected string $view = 'filament.tables.columns.stackable-column';

    protected array | Closure $components = [];

    protected string $flexDirection = 'col';

    protected string $gap = '1.5';

    public function components(array | Closure $components): static
    {
        $this->components = $components;

        return $this;
    }

    public function flexDirection(string $direction): static
    {
        $this->flexDirection = $direction;

        return $this;
    }

    public function gap(string $gap): static
    {
        $this->gap = $gap;

        return $this;
    }

    public function getComponents(): array
    {
        return array_map(function (Component | Column $component): Component | Column {
            return $component;
        }, $this->evaluate($this->components));
    }

    public function getFlexDirection(): string
    {
        return $this->flexDirection;
    }

    public function getGap(): string
    {
        return $this->gap;
    }

    // final public function __construct(string $view)
    // {
    //     $this->view($view);
    // }

    // /**
    //  * @param  view-string  $view
    //  */
    // public static function make(): static
    // {
    //     $static = app(static::class, ['view' => 'filament.tables.columns.stackable-column']);
    //     $static->configure();

    //     return $static;
    // }
}
