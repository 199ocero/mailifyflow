@props(['data'])
@php
    switch ($data['type']) {
        case 'h1':
            $tagClass = 'text-3xl';
            break;
        case 'h2':
            $tagClass = 'text-2xl';
            break;
        case 'h3':
            $tagClass = 'text-xl';
            break;
        case 'h4':
            $tagClass = 'text-lg';
            break;
        case 'h5':
            $tagClass = 'text-base';
            break;
        case 'h6':
            $tagClass = 'text-sm';
            break;
        default:
            $tagClass = 'text-xl';
            break;
    }
@endphp
<div class="w-full">
    <h{{ $data['type'] }} class="font-bold {{ $tagClass }}">
        {{ $data['label'] }}
        </h{{ $data['type'] }}>
</div>
