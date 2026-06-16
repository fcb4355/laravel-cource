<x-layout title="notes">

    <x-slot:heading>
        Notes

        <a href="notes/create"
            class="rounded-md bg-purple-500 px-4 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500">
            Create note
        </a>

    </x-slot:heading>

    @if ($notes->count())
        <div class="grid grid-cols-4 gap-4">
            @foreach ($notes as $note)
                <x-note href='notes/{{ $note->id }}' title='{{ $note->title }}' status="{{ $note->status }}"
                    description="{{ $note->description }}"></x-note>
            @endforeach
        </div>
    @else
        <div
            class="max-w-sm mx-auto rounded-xl border border-gray-300 bg-gray-50 p-8 text-center dark:border-gray-800 dark:bg-gray-950/50">
            <svg class="mx-auto h-15 w-15 text-gray-400 dark:text-gray-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>

            <h3 class="mt-4 text-sm font-semibold text-gray-900 dark:text-gray-50">
                No notes found
            </h3>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                You don't have any notes yet. Create one to get started.
            </p>
        </div>
    @endif


    @unless ($notes->count() == 0)
        <form method="post" action="/notes">
            @csrf
            @method('delete')

            <button type="submit"
                class="rounded-md bg-red-500 px-5 py-1.5 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500 mt-5 inline-block">Delete
                all</button>
        </form>
    @endunless




</x-layout>
