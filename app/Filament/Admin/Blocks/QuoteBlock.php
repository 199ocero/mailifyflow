<?php

namespace App\Filament\Admin\Blocks;

use Filament\Forms;
use Filament\Support\Colors\Color;
use FilamentTiptapEditor\TiptapBlock;

class QuoteBlock extends TiptapBlock
{
    public string $preview = 'filament.blocks.previews.quote';

    public string $rendered = 'filament.blocks.rendered.quote';

    public function getFormSchema(): array
    {
        return [
            Forms\Components\Textarea::make('label')
                ->label('Quote')
                ->placeholder('e.g. Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
                ->autosize()
                ->required(),
            Forms\Components\Select::make('color')
                ->label('Color')
                ->options(
                    collect(Color::all())
                        ->mapWithKeys(fn ($color, $name) => [
                            $name => "
                            <div class='flex items-center justify-between gap-4'>
                                <div class='w-4 h-4 rounded-full' style='background:rgb(" . $color[500] . ")'>
                            </div>
                                <span>" . str($name)->title() . '</span>
                            </div>'
                        ])
                        ->reverse()
                )
                ->allowHtml()
                ->required(),
        ];
    }
}
