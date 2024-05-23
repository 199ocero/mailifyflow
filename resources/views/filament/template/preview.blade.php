<div class="grid gap-3 pt-5 border-t border-gray-200 dark:border-gray-800">
    @foreach ($content as $key => $item)
        @switch($item['type'])
            @case('heading')
                @include('filament.template.blocks.heading', ['data' => $item])
            @break

            @case('paragraph')
                @include('filament.template.blocks.paragraph', ['data' => $item])
            @break

            @case('bulletList')
                @include('filament.template.blocks.bullet-list', ['data' => $item])
            @break

            @case('orderedList')
                @include('filament.template.blocks.ordered-list', ['data' => $item])
            @break

            @case('tiptapBlock')
                @if ($item['attrs']['type'] == 'buttonBlock')
                    @include('filament.template.blocks.button', ['data' => $item])
                @elseif ($item['attrs']['type'] == 'quoteBlock')
                    @include('filament.template.blocks.quote', ['data' => $item])
                @elseif ($item['attrs']['type'] == 'contentBlock')
                    @include('filament.template.blocks.content')
                @endif
            @break

            @case('horizontalRule')
                @include('filament.template.blocks.divider')
            @break

            {{-- @case('quote')
                
            @break --}}

            {{-- @case('code')
                @include('filament.template.blocks.code', ['data' => $item['data']])
            @break --}}

            @default
        @endswitch
    @endforeach
</div>
