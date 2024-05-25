@props(['data'])
<div class="grid w-full gap-2">
    <div class="grid gap-0">
        @if (!empty($data['label']))
            <p class="text-base">{{ $data['label'] }}</p>
        @endif
        @if (!empty($data['description']))
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $data['description'] }}</p>
        @endif
    </div>
    @if ($data['type'] == 'bullet')
        <ul class="grid gap-1 pl-4 list-disc">
            @foreach ($data['items'] as $item)
                <li class="text-sm">{{ $item['content'] }}</li>
            @endforeach
        </ul>
    @elseif ($data['type'] == 'number')
        <ol class="grid gap-1 pl-4 list-decimal">
            @foreach ($data['items'] as $item)
                <li class="text-sm">{{ $item['content'] }}</li>
            @endforeach
        </ol>
    @endif
</div>
