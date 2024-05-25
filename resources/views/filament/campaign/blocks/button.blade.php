@props(['data'])
@php

    if (is_array($data['attrs']['data'])) {
        $decodedData = $data['attrs']['data'];
    } else {
        $pattern = '/JSON\.parse\(\'(.*?)\'\)/';
        preg_match($pattern, $data['attrs']['data'], $matches);

        // Extracted JSON string
        $jsonStr = isset($matches[1]) ? $matches[1] : '';

        $jsonString = preg_replace_callback(
            '/\\\\u([0-9a-fA-F]{4})/',
            function ($matches) {
                return mb_convert_encoding(pack('H*', $matches[1]), 'UTF-8', 'UCS-2BE');
            },
            $jsonStr,
        );

        // Decode the fixed JSON string into an associative array
        $decodedData = json_decode($jsonString, true);
    }

    switch ($decodedData['color']) {
        case 'slate':
            $color =
                'bg-slate-600 hover:bg-slate-500 focus-visible:ring-slate-500/50 dark:bg-slate-500 dark:hover:bg-slate-400 dark:focus-visible:ring-slate-400/50';
            break;
        case 'gray':
            $color =
                'bg-gray-600 hover:bg-gray-500 focus-visible:ring-gray-500/50 dark:bg-gray-500 dark:hover:bg-gray-400 dark:focus-visible:ring-gray-400/50';
            break;
        case 'zinc':
            $color =
                'bg-zinc-600 hover:bg-zinc-500 focus-visible:ring-zinc-500/50 dark:bg-zinc-500 dark:hover:bg-zinc-400 dark:focus-visible:ring-zinc-400/50';
            break;
        case 'neutral':
            $color =
                'bg-neutral-600 hover:bg-neutral-500 focus-visible:ring-neutral-500/50 dark:bg-neutral-500 dark:hover:bg-neutral-400 dark:focus-visible:ring-neutral-400/50';
            break;
        case 'stone':
            $color =
                'bg-stone-600 hover:bg-stone-500 focus-visible:ring-stone-500/50 dark:bg-stone-500 dark:hover:bg-stone-400 dark:focus-visible:ring-stone-400/50';
            break;
        case 'red':
            $color =
                'bg-red-600 hover:bg-red-500 focus-visible:ring-red-500/50 dark:bg-red-500 dark:hover:bg-red-400 dark:focus-visible:ring-red-400/50';
            break;
        case 'orange':
            $color =
                'bg-orange-600 hover:bg-orange-500 focus-visible:ring-orange-500/50 dark:bg-orange-500 dark:hover:bg-orange-400 dark:focus-visible:ring-orange-400/50';
            break;
        case 'amber':
            $color =
                'bg-amber-600 hover:bg-amber-500 focus-visible:ring-amber-500/50 dark:bg-amber-500 dark:hover:bg-amber-400 dark:focus-visible:ring-amber-400/50';
            break;
        case 'yellow':
            $color =
                'bg-yellow-600 hover:bg-yellow-500 focus-visible:ring-yellow-500/50 dark:bg-yellow-500 dark:hover:bg-yellow-400 dark:focus-visible:ring-yellow-400/50';
            break;
        case 'lime':
            $color =
                'bg-lime-600 hover:bg-lime-500 focus-visible:ring-lime-500/50 dark:bg-lime-500 dark:hover:bg-lime-400 dark:focus-visible:ring-lime-400/50';
            break;
        case 'green':
            $color =
                'bg-green-600 hover:bg-green-500 focus-visible:ring-green-500/50 dark:bg-green-500 dark:hover:bg-green-400 dark:focus-visible:ring-green-400/50';
            break;
        case 'emerald':
            $color =
                'bg-emerald-600 hover:bg-emerald-500 focus-visible:ring-emerald-500/50 dark:bg-emerald-500 dark:hover:bg-emerald-400 dark:focus-visible:ring-emerald-400/50';
            break;
        case 'teal':
            $color =
                'bg-teal-600 hover:bg-teal-500 focus-visible:ring-teal-500/50 dark:bg-teal-500 dark:hover:bg-teal-400 dark:focus-visible:ring-teal-400/50';
            break;
        case 'cyan':
            $color =
                'bg-cyan-600 hover:bg-cyan-500 focus-visible:ring-cyan-500/50 dark:bg-cyan-500 dark:hover:bg-cyan-400 dark:focus-visible:ring-cyan-400/50';
            break;
        case 'sky':
            $color =
                'bg-sky-600 hover:bg-sky-500 focus-visible:ring-sky-500/50 dark:bg-sky-500 dark:hover:bg-sky-400 dark:focus-visible:ring-sky-400/50';
            break;
        case 'blue':
            $color =
                'bg-blue-600 hover:bg-blue-500 focus-visible:ring-blue-500/50 dark:bg-blue-500 dark:hover:bg-blue-400 dark:focus-visible:ring-blue-400/50';
            break;
        case 'indigo':
            $color =
                'bg-indigo-600 hover:bg-indigo-500 focus-visible:ring-indigo-500/50 dark:bg-indigo-500 dark:hover:bg-indigo-400 dark:focus-visible:ring-indigo-400/50';
            break;
        case 'violet':
            $color =
                'bg-violet-600 hover:bg-violet-500 focus-visible:ring-violet-500/50 dark:bg-violet-500 dark:hover:bg-violet-400 dark:focus-visible:ring-violet-400/50';
            break;
        case 'purple':
            $color =
                'bg-purple-600 hover:bg-purple-500 focus-visible:ring-purple-500/50 dark:bg-purple-500 dark:hover:bg-purple-400 dark:focus-visible:ring-purple-400/50';
            break;
        case 'fuchsia':
            $color =
                'bg-fuchsia-600 hover:bg-fuchsia-500 focus-visible:ring-fuchsia-500/50 dark:bg-fuchsia-500 dark:hover:bg-fuchsia-400 dark:focus-visible:ring-fuchsia-400/50';
            break;
        case 'pink':
            $color =
                'bg-pink-600 hover:bg-pink-500 focus-visible:ring-pink-500/50 dark:bg-pink-500 dark:hover:bg-pink-400 dark:focus-visible:ring-pink-400/50';
            break;
        case 'rose':
            $color =
                'bg-rose-600 hover:bg-rose-500 focus-visible:ring-rose-500/50 dark:bg-rose-500 dark:hover:bg-rose-400 dark:focus-visible:ring-rose-400/50';
            break;
        default:
            break;
    }

    switch ($decodedData['position']) {
        case 'left':
            $position = 'justify-start';
            break;
        case 'center':
            $position = 'justify-center';
            break;
        case 'right':
            $position = 'justify-end';
            break;
        default:
            # code...
            break;
    }
@endphp
<div class="flex w-full {{ $position }}">
    <a href="{{ $decodedData['url'] }}" target="{{ $decodedData['target'] }}"
        class="{{ $color }} relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm  text-white">
        {{ $decodedData['label'] }}
    </a>
</div>
