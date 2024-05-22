@props(['data'])
<ol class="grid gap-1 pl-4 list-decimal">
    @foreach ($data['content'] as $listItem)
        @if ($listItem['type'] === 'listItem')
            <li>
                @foreach ($listItem['content'] as $paragraph)
                    @if ($paragraph['type'] === 'paragraph')
                        @foreach ($paragraph['content'] as $text)
                            @if ($text['type'] === 'text')
                                {{ $text['text'] }}
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </li>
        @endif
    @endforeach
</ol>
