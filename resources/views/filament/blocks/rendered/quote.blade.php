@php
    switch ($color) {
        case 'slate':
            $quoteColor = 'border-slate-300 bg-slate-50';
            break;

        case 'gray':
            $quoteColor = 'border-gray-300 bg-gray-50';
            break;

        case 'zinc':
            $quoteColor = 'border-zinc-300 bg-zinc-50';
            break;

        case 'neutral':
            $quoteColor = 'border-neutral-300 bg-neutral-50';
            break;

        case 'stone':
            $quoteColor = 'border-stone-300 bg-stone-50';
            break;

        case 'red':
            $quoteColor = 'border-red-300 bg-red-50';
            break;

        case 'orange':
            $quoteColor = 'border-orange-300 bg-orange-50';
            break;

        case 'amber':
            $quoteColor = 'border-amber-300 bg-amber-50';
            break;

        case 'yellow':
            $quoteColor = 'border-yellow-300 bg-yellow-50';
            break;

        case 'lime':
            $quoteColor = 'border-lime-300 bg-lime-50';
            break;

        case 'green':
            $quoteColor = 'border-green-300 bg-green-50';
            break;

        case 'emerald':
            $quoteColor = 'border-emerald-300 bg-emerald-50';
            break;

        case 'teal':
            $quoteColor = 'border-teal-300 bg-teal-50';
            break;

        case 'cyan':
            $quoteColor = 'border-cyan-300 bg-cyan-50';
            break;

        case 'sky':
            $quoteColor = 'border-sky-300 bg-sky-50';
            break;

        case 'blue':
            $quoteColor = 'border-blue-300 bg-blue-50';
            break;

        case 'indigo':
            $quoteColor = 'border-indigo-300 bg-indigo-50';
            break;

        case 'violet':
            $quoteColor = 'border-violet-300 bg-violet-50';
            break;

        case 'purple':
            $quoteColor = 'border-purple-300 bg-purple-50';
            break;

        case 'fuchsia':
            $quoteColor = 'border-fuchsia-300 bg-fuchsia-50';
            break;

        case 'pink':
            $quoteColor = 'border-pink-300 bg-pink-100';
            break;

        case 'rose':
            $quoteColor = 'border-rose-300 bg-rose-50';
            break;
        default:
            # code...
            break;
    }
@endphp
<p class="p-4 m-0 text-xl italic font-medium leading-6 text-gray-900 {{ $quoteColor }} rounded-lg"
    style="border-left-width: 4px; border-left-style: solid;">
    {{ $label }}
</p>
