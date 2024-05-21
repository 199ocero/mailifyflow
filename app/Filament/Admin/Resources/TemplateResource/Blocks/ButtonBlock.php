<?php

namespace App\Filament\Admin\Resources\TemplateResource\Blocks;

use Filament\Forms;
use Filament\Support\Colors\Color;
use FilamentTiptapEditor\TiptapBlock;

class ButtonBlock extends TiptapBlock
{
    public string $preview = 'filament.blocks.previews.button';

    public string $rendered = 'filament.blocks.rendered.button';

    public function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('label')
                ->label('Label')
                ->placeholder('e.g. Subscribe')
                ->string()
                ->required(),
            Forms\Components\Select::make('position')
                ->label('Position')
                ->options([
                    'left' => 'Left',
                    'right' => 'Right',
                    'center' => 'Center',
                ])
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
            Forms\Components\TextInput::make('url')
                ->label('Url')
                ->placeholder('e.g. https://example.com')
                ->url()
                ->required(),
            Forms\Components\Select::make('target')
                ->label('Target')
                ->options([
                    '_blank' => 'Open in New Tab',
                    '_self' => 'Open in Same Tab',
                ])
                ->required(),
        ];
    }
}
