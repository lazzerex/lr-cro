@php
    $direction = $getFlexDirection();

    $directionClass = match($direction) {
        'col' => 'flex-col',
        'row' => 'flex-row',
        'col-reverse' => 'flex-col-reverse',
        'row-reverse' => 'flex-row-reverse',
        default => 'flex-col'
    };
@endphp

<div {{
        $attributes
            ->merge($getExtraAttributes(), escape: false)
            ->class([
                'fi-ta-text flex gap-1.5',
                'px-3 py-4',
                $directionClass,
            ])
    }}>
    <x-filament-tables::columns.layout
        :components="$getComponents()"
        :record="$getRecord()"
        :record-key="$recordKey"
    />
</div>
