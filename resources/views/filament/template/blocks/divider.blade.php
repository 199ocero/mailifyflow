@props(['data'])
@php
    switch ($data['color']) {
        case 'slate':
            $color = 'bg-slate-600 dark:bg-slate-500';
            break;
        case 'gray':
            $color = 'bg-gray-600 dark:bg-gray-500';
            break;
        case 'zinc':
            $color = 'bg-zinc-600 dark:bg-zinc-500';
            break;
        case 'neutral':
            $color = 'bg-neutral-600 dark:bg-neutral-500';
            break;
        case 'stone':
            $color = 'bg-stone-600 dark:bg-stone-500';
            break;
        case 'red':
            $color = 'bg-red-600 dark:bg-red-500';
            break;
        case 'orange':
            $color = 'bg-orange-600 dark:bg-orange-500';
            break;
        case 'amber':
            $color = 'bg-amber-600 dark:bg-amber-500';
            break;
        case 'yellow':
            $color = 'bg-yellow-600 dark:bg-yellow-500';
            break;
        case 'lime':
            $color = 'bg-lime-600 dark:bg-lime-500';
            break;
        case 'green':
            $color = 'bg-green-600 dark:bg-green-500';
            break;
        case 'emerald':
            $color = 'bg-emerald-600 dark:bg-emerald-500';
            break;
        case 'teal':
            $color = 'bg-teal-600 dark:bg-teal-500';
            break;
        case 'cyan':
            $color = 'bg-cyan-600 dark:bg-cyan-500';
            break;
        case 'sky':
            $color = 'bg-sky-600 dark:bg-sky-500';
            break;
        case 'blue':
            $color = 'bg-blue-600 dark:bg-blue-500';
            break;
        case 'indigo':
            $color = 'bg-indigo-600 dark:bg-indigo-500';
            break;
        case 'violet':
            $color = 'bg-violet-600 dark:bg-violet-500';
            break;
        case 'purple':
            $color = 'bg-purple-600 dark:bg-purple-500';
            break;
        case 'fuchsia':
            $color = 'bg-fuchsia-600 dark:bg-fuchsia-500';
            break;
        case 'pink':
            $color = 'bg-pink-600 dark:bg-pink-500';
            break;
        case 'rose':
            $color = 'bg-rose-600 dark:bg-rose-500';
            break;
        default:
            break;
    }
@endphp
<div class="w-full h-[0.5px] {{ $color }}"></div>
