@props(['head', 'body'])

<div class="relative overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-800">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase bg-gray-50/80 dark:bg-gray-700/80 backdrop-blur-sm">
                <tr class="border-b border-gray-200 dark:border-gray-600">
                    {{ $head }}
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-600 bg-white dark:bg-gray-800">
                {{ $body }}
            </tbody>
        </table>
    </div>
</div>
