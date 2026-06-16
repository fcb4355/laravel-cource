@props([
    'title' => 'Unknown',
    'status' => 'pending',
    'description' => 'Unknown',
])

<a class="w-full rounded-lg border border-gray-300 bg-white p-5 shadow-sm transition-all hover:shadow-md dark:border-gray-700 dark:bg-gray-800"
    {{ $attributes }}>
    <div class="flex items-center justify-between gap-4">
        <h3 class="truncate text-base font-semibold text-gray-900 dark:text-gray-50" title="{{ $title }}">
            {{ $title }}
        </h3>
        <span
            class="inline-flex shrink-0 items-center rounded-md bg-amber-50 px-2 py-1 text-xs font-medium text-amber-800 ring-1 ring-inset ring-amber-600/20 dark:bg-amber-950 dark:text-amber-400 dark:ring-amber-500/20">
            {{ $status }}
        </span>
    </div>

    <p class="mt-2 text-sm leading-relaxed text-gray-600 dark:text-gray-400">
        {{ $description }}
    </p>
</a>
