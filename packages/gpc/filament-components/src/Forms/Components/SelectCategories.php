<?php
namespace Gpc\FilamentComponents\Forms\Components;

use Closure;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Illuminate\Contracts\Support\Arrayable;

class SelectCategories
{
    private string $label;
    private string $primaryIdLabel;
    private string $primaryIdAttribute;
    private array | Arrayable | string | Closure | null $primaryIdOptions;
    private string $relationship;
    private string $relationshipTitleAttribute = 'name';
    private string $relationshipParentAttribute = 'parent_id';
    private ?Closure $modifyQueryUsing = null;

    public static function make()
    {
        return new static;
    }

    public function build()
    {
        return Group::make([
            SelectTree::make($this->relationship)
                ->label($this->label)
                ->relationship(
                    $this->relationship,
                    $this->relationshipTitleAttribute,
                    $this->relationshipParentAttribute,
                    $this->modifyQueryUsing
                )
                ->enableBranchNode()
                ->defaultOpenLevel(2),
            Select::make($this->primaryIdAttribute)
                ->label($this->primaryIdLabel)
                ->options($this->primaryIdOptions)
                ->extraInputAttributes([ 'class' => 'primary-category', ]),
        ])
        ->columns(['md' => 2])
        ->extraAttributes(['class' => 'select-categories']);
    }

    public function label(string $label)
    {
        $this->label = $label;

        return $this;
    }

    public function primaryIdLabel(string $primaryIdLabel)
    {
        $this->primaryIdLabel = $primaryIdLabel;

        return $this;
    }

    public function primaryIdAttribute(string $primaryIdAttribute)
    {
        $this->primaryIdAttribute = $primaryIdAttribute;

        return $this;
    }

    public function primaryIdOptions(array | Arrayable | string | Closure | null $primaryIdOptions)
    {
        $this->primaryIdOptions = $primaryIdOptions;

        return $this;
    }

    public function relationship(string $relationship, string $titleAttribute, string $parentAttribute, ?Closure $modifyQueryUsing = null)
    {
        $this->relationship = $relationship;
        $this->relationshipTitleAttribute = $titleAttribute;
        $this->relationshipParentAttribute = $parentAttribute;
        $this->modifyQueryUsing = $modifyQueryUsing;

        return $this;
    }

}