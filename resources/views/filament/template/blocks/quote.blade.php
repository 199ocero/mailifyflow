@props(['data'])
@php
    switch ($data['color']) {
        case 'slate':
            $color = 'border-slate-300 bg-slate-50 dark:border-slate-300 dark:bg-slate-700';
            break;

        case 'gray':
            $color = 'border-gray-300 bg-gray-50 dark:border-gray-300 dark:bg-gray-700';
            break;

        case 'zinc':
            $color = 'border-zinc-300 bg-zinc-50 dark:border-zinc-300 dark:bg-zinc-700';
            break;

        case 'neutral':
            $color = 'border-neutral-300 bg-neutral-50 dark:border-neutral-300 dark:bg-neutral-700';
            break;

        case 'stone':
            $color = 'border-stone-300 bg-stone-50 dark:border-stone-300 dark:bg-stone-700';
            break;

        case 'red':
            $color = 'border-red-300 bg-red-50 dark:border-red-300 dark:bg-red-700';
            break;

        case 'orange':
            $color = 'border-orange-300 bg-orange-50 dark:border-orange-300 dark:bg-orange-700';
            break;

        case 'amber':
            $color = 'border-amber-300 bg-amber-50 dark:border-amber-300 dark:bg-amber-700';
            break;

        case 'yellow':
            $color = 'border-yellow-300 bg-yellow-50 dark:border-yellow-300 dark:bg-yellow-700';
            break;

        case 'lime':
            $color = 'border-lime-300 bg-lime-50 dark:border-lime-300 dark:bg-lime-700';
            break;

        case 'green':
            $color = 'border-green-300 bg-green-50 dark:border-green-300 dark:bg-green-700';
            break;

        case 'emerald':
            $color = 'border-emerald-300 bg-emerald-50 dark:border-emerald-300 dark:bg-emerald-700';
            break;

        case 'teal':
            $color = 'border-teal-300 bg-teal-50 dark:border-teal-300 dark:bg-teal-700';
            break;

        case 'cyan':
            $color = 'border-cyan-300 bg-cyan-50 dark:border-cyan-300 dark:bg-cyan-700';
            break;

        case 'sky':
            $color = 'border-sky-300 bg-sky-50 dark:border-sky-300 dark:bg-sky-700';
            break;

        case 'blue':
            $color = 'border-blue-300 bg-blue-50 dark:border-blue-300 dark:bg-blue-700';
            break;

        case 'indigo':
            $color = 'border-indigo-300 bg-indigo-50 dark:border-indigo-300 dark:bg-indigo-700';
            break;

        case 'violet':
            $color = 'border-violet-300 bg-violet-50 dark:border-violet-300 dark:bg-violet-700';
            break;

        case 'purple':
            $color = 'border-purple-300 bg-purple-50 dark:border-purple-300 dark:bg-purple-700';
            break;

        case 'fuchsia':
            $color = 'border-fuchsia-300 bg-fuchsia-50 dark:border-fuchsia-300 dark:bg-fuchsia-700';
            break;

        case 'pink':
            $color = 'border-pink-300 bg-pink-50 dark:border-pink-300 dark:bg-pink-700';
            break;

        case 'rose':
            $color = 'border-rose-300 bg-rose-50 dark:border-rose-300 dark:bg-rose-700';
            break;
        default:
            # code...
            break;
    }
@endphp
<div class="w-full">
    <blockquote class="p-4 my-4 border-s-4 {{ $color }} rounded-lg">
        <p class="text-xl italic font-medium leading-relaxed text-gray-900 dark:text-white">
            {{ $data['label'] }}
        </p>
    </blockquote>
</div>
