@props(['data'])
<div class="w-full">
    <div class="px-3 py-2 bg-gray-100 rounded-lg dark:bg-gray-800">
        <code class="text-xs text-red-600 dark:text-red-400">{{ $data['content'] }}</code>
    </div>
</div>
