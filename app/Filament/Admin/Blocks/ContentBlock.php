<?php

namespace App\Filament\Admin\Blocks;

use FilamentTiptapEditor\TiptapBlock;

class ContentBlock extends TiptapBlock
{
    public string $preview = 'filament.blocks.previews.content';

    public string $rendered = 'filament.blocks.rendered.content';
}
