<div class="grid gap-3">
    @foreach ($campaignContent as $key => $item)
        @switch($item['type'])
            @case('heading')
                @include('filament.campaign.blocks.heading', ['data' => $item])
            @break

            @case('paragraph')
                @include('filament.campaign.blocks.paragraph', ['data' => $item])
            @break

            @case('bulletList')
                @include('filament.campaign.blocks.bullet-list', ['data' => $item])
            @break

            @case('orderedList')
                @include('filament.campaign.blocks.ordered-list', ['data' => $item])
            @break

            @case('tiptapBlock')
                @if ($item['attrs']['type'] == 'buttonBlock')
                    @include('filament.campaign.blocks.button', ['data' => $item])
                @elseif ($item['attrs']['type'] == 'quoteBlock')
                    @include('filament.campaign.blocks.quote', ['data' => $item])
                @endif
            @break

            @case('horizontalRule')
                @include('filament.campaign.blocks.divider')
            @break

            @default
        @endswitch
    @endforeach
</div>
