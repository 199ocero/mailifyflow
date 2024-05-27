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
            $color = 'border-slate-300 bg-slate-50';
            break;

        case 'gray':
            $color = 'border-gray-300 bg-gray-50';
            break;

        case 'zinc':
            $color = 'border-zinc-300 bg-zinc-50';
            break;

        case 'neutral':
            $color = 'border-neutral-300 bg-neutral-50';
            break;

        case 'stone':
            $color = 'border-stone-300 bg-stone-50';
            break;

        case 'red':
            $color = 'border-red-300 bg-red-50';
            break;

        case 'orange':
            $color = 'border-orange-300 bg-orange-50';
            break;

        case 'amber':
            $color = 'border-amber-300 bg-amber-50';
            break;

        case 'yellow':
            $color = 'border-yellow-300 bg-yellow-50';
            break;

        case 'lime':
            $color = 'border-lime-300 bg-lime-50';
            break;

        case 'green':
            $color = 'border-green-300 bg-green-50';
            break;

        case 'emerald':
            $color = 'border-emerald-300 bg-emerald-50';
            break;

        case 'teal':
            $color = 'border-teal-300 bg-teal-50';
            break;

        case 'cyan':
            $color = 'border-cyan-300 bg-cyan-50';
            break;

        case 'sky':
            $color = 'border-sky-300 bg-sky-50';
            break;

        case 'blue':
            $color = 'border-blue-300 bg-blue-50';
            break;

        case 'indigo':
            $color = 'border-indigo-300 bg-indigo-50';
            break;

        case 'violet':
            $color = 'border-violet-300 bg-violet-50';
            break;

        case 'purple':
            $color = 'border-purple-300 bg-purple-50';
            break;

        case 'fuchsia':
            $color = 'border-fuchsia-300 bg-fuchsia-50';
            break;

        case 'pink':
            $color = 'border-pink-300 bg-pink-100';
            break;

        case 'rose':
            $color = 'border-rose-300 bg-rose-50';
            break;
        default:
            # code...
            break;
    }
@endphp
<p class="p-4 m-0 text-xl italic font-medium leading-6 text-gray-900 {{ $color }} rounded-lg"
    style="border-left-width: 4px; border-left-style: solid;">
    {{ $decodedData['label'] }}
</p>
