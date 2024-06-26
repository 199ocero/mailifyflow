@props(['data'])
<ul class="grid gap-1 pl-8 m-0 leading-6 list-disc">
    @foreach ($data['content'] as $listItem)
        @if ($listItem['type'] === 'listItem')
            <li>
                @if (isset($listItem['content']))
                    @foreach ($listItem['content'] as $paragraph)
                        @if ($paragraph['type'] === 'paragraph' && isset($paragraph['content']))
                            @foreach ($paragraph['content'] as $text)
                                @if ($text['type'] === 'text')
                                    {{ $text['text'] }}
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </li>
        @endif
    @endforeach
</ul>
