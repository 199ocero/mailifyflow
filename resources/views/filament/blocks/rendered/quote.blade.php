@php
    switch ($color) {
        case 'slate':
            $quoteColor = '!border-slate-300 bg-slate-100 dark:!border-slate-300 dark:bg-slate-700';
            break;

        case 'gray':
            $quoteColor = '!border-gray-300 bg-gray-100 dark:!border-gray-300 dark:bg-gray-700';
            break;

        case 'zinc':
            $quoteColor = '!border-zinc-300 bg-zinc-100 dark:!border-zinc-300 dark:bg-zinc-700';
            break;

        case 'neutral':
            $quoteColor = '!border-neutral-300 bg-neutral-100 dark:!border-neutral-300 dark:bg-neutral-700';
            break;

        case 'stone':
            $quoteColor = '!border-stone-300 bg-stone-100 dark:!border-stone-300 dark:bg-stone-700';
            break;

        case 'red':
            $quoteColor = '!border-red-300 bg-red-100 dark:!border-red-300 dark:bg-red-700';
            break;

        case 'orange':
            $quoteColor = '!border-orange-300 bg-orange-100 dark:!border-orange-300 dark:bg-orange-700';
            break;

        case 'amber':
            $quoteColor = '!border-amber-300 bg-amber-100 dark:!border-amber-300 dark:bg-amber-700';
            break;

        case 'yellow':
            $quoteColor = '!border-yellow-300 bg-yellow-100 dark:!border-yellow-300 dark:bg-yellow-700';
            break;

        case 'lime':
            $quoteColor = '!border-lime-300 bg-lime-100 dark:!border-lime-300 dark:bg-lime-700';
            break;

        case 'green':
            $quoteColor = '!border-green-300 bg-green-100 dark:!border-green-300 dark:bg-green-700';
            break;

        case 'emerald':
            $quoteColor = '!border-emerald-300 bg-emerald-100 dark:!border-emerald-300 dark:bg-emerald-700';
            break;

        case 'teal':
            $quoteColor = '!border-teal-300 bg-teal-100 dark:!border-teal-300 dark:bg-teal-700';
            break;

        case 'cyan':
            $quoteColor = '!border-cyan-300 bg-cyan-100 dark:!border-cyan-300 dark:bg-cyan-700';
            break;

        case 'sky':
            $quoteColor = '!border-sky-300 bg-sky-100 dark:!border-sky-300 dark:bg-sky-700';
            break;

        case 'blue':
            $quoteColor = '!border-blue-300 bg-blue-100 dark:!border-blue-300 dark:bg-blue-700';
            break;

        case 'indigo':
            $quoteColor = '!border-indigo-300 bg-indigo-100 dark:!border-indigo-300 dark:bg-indigo-700';
            break;

        case 'violet':
            $quoteColor = '!border-violet-300 bg-violet-100 dark:!border-violet-300 dark:bg-violet-700';
            break;

        case 'purple':
            $quoteColor = '!border-purple-300 bg-purple-100 dark:!border-purple-300 dark:bg-purple-700';
            break;

        case 'fuchsia':
            $quoteColor = '!border-fuchsia-300 bg-fuchsia-100 dark:!border-fuchsia-300 dark:bg-fuchsia-700';
            break;

        case 'pink':
            $quoteColor = '!border-pink-300 bg-pink-100 dark:!border-pink-300 dark:bg-pink-700';
            break;

        case 'rose':
            $quoteColor = '!border-rose-300 bg-rose-100 dark:!border-rose-300 dark:bg-rose-700';
            break;
        default:
            # code...
            break;
    }
@endphp
<div class="w-full">
    <blockquote class="p-4 border-s-4 {{ $quoteColor }} rounded-lg !ms-0">
        <p class="text-xl italic font-medium leading-relaxed text-gray-900 dark:text-white">
            {{ $label }}
        </p>
    </blockquote>
</div>
