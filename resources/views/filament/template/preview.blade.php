<div class="grid gap-3 pt-5 border-t border-gray-200 dark:border-gray-800">
    @foreach ($content as $key => $item)
        @switch($item['type'])
            @case('heading')
                @include('filament.template.blocks.heading', ['data' => $item['data']])
            @break

            @case('paragraph')
                @include('filament.template.blocks.paragraph', ['data' => $item['data']])
            @break

            @case('list')
                @include('filament.template.blocks.list', ['data' => $item['data']])
            @break

            @case('button')
                @include('filament.template.blocks.button', ['data' => $item['data']])
            @break

            @case('divider')
                @include('filament.template.blocks.divider', ['data' => $item['data']])
            @break

            @case('quote')
                @include('filament.template.blocks.quote', ['data' => $item['data']])
            @break

            @case('code')
                @include('filament.template.blocks.code', ['data' => $item['data']])
            @break

            @default
        @endswitch
    @endforeach
</div>
