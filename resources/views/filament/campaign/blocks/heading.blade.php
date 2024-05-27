@props(['data'])
@php
    switch ($data['attrs']['level']) {
        case 1:
            $tagClass = 'text-3xl';
            break;
        case 2:
            $tagClass = 'text-2xl';
            break;
        case 3:
            $tagClass = 'text-xl';
            break;
        case 4:
            $tagClass = 'text-lg';
            break;
        case 5:
            $tagClass = 'text-base';
            break;
        case 6:
            $tagClass = 'text-sm';
            break;
        default:
            $tagClass = 'text-xl';
            break;
    }
@endphp
<h{{ $data['attrs']['level'] }} class="font-bold m-0 leading-6 {{ $tagClass }}">
    {{ $data['content'][0]['text'] }}
    </h{{ $data['attrs']['level'] }}>
