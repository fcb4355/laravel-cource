<x-layout title="notes">

    <x-slot:heading> Edit note </x-slot:heading>

    <form method="POST" action="/notes/{{ $note->id }}" class="max-w-xl mx-auto">

        @method('PATCH')

        <!-- Note Title -->
        <div class="sm:col-span-4">
            <label for="title" class="block text-sm/6 font-medium text-white">Title</label>
            <div
                class="flex items-center rounded-md bg-white/5 pl-3 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-purple-500 mt-2">
                <input id="title" type="text" name="title" placeholder="Build UI"
                    class="block min-w-0 grow bg-transparent py-2 pr-3 pl-1 text-gray-300 font-semibold placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                    value="{{ $note->title }}" />
            </div>
            <x-error name="title"></x-error>
        </div>

        <!-- Note Description -->
        <div class="col-span-full mt-6">
            <label for="description" class="block text-sm/6 font-medium text-white">Description</label>
            <div class="mt-2">
                <textarea id="description" name="description" rows="3"
                    class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500 sm:text-sm/6"
                    placeholder="Complete the remaining form inputs">{{ $note->description }}</textarea>
            </div>
            <x-error name="description"></x-error>
        </div>

        <!-- Note Status -->
        <div class="sm:col-span-3 mt-6">
            <label for="status" class="block text-sm/6 font-medium text-white">status</label>
            <div class="mt-2 grid grid-cols-1">
                <select id="status" name="status"
                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white/5 py-2 pr-8 pl-3 text-base text-white outline-1 -outline-offset-1 outline-white/10 *:bg-gray-800 focus:outline-2 focus:-outline-offset-2 focus:outline-purple-500 sm:text-sm/6">
                    <option value="" selected disabled>---Choose status---</option>
                    <option value="pending" {{ $note->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="progress" {{ $note->status === 'progress' ? 'selected' : '' }}>Progress</option>
                    <option value="completed" {{ $note->status === 'completed' ? 'selected' : '' }}>Completed
                    </option>
                    <option value="cancelled" {{ $note->status === 'cancelled' ? 'selected' : '' }}>Cancelled
                    </option>
                </select>
                <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true"
                    class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-400 sm:size-4">
                    <path
                        d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                        clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
            </div>
            <x-error name="status"></x-error>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-3">
            <a href="/notes/{{ $note->id }}"
                class="rounded-md bg-gray-400 px-5 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">Cancel</a>
            <button type="submit"
                class="rounded-md bg-green-600 px-5 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500">Update</button>
        </div>

    </form>



</x-layout>
