@props(['head', 'body'])

<div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-gray-200 dark:border-gray-700">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
            <tr>
                {{ $head }}
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            {{ $body }}
        </tbody>
    </table>
</div>
