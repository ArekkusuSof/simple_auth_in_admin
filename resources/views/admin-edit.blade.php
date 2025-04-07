<x-layout>
    <x-slot:heading>
      Edit Record from {{ ucfirst($table) }} Table
    </x-slot:heading>

    <form method="POST" action="{{ route('admin.update', ['table' => $table, 'id' => $record->id]) }}">
      @csrf
      @method('PUT')

      @foreach((array)$record as $column => $value)
        <div class="mb-4">
          <label for="{{ $column }}" class="block text-sm font-medium text-gray-700">
            {{ ucfirst($column) }}
          </label>
          <input type="text" name="{{ $column }}" id="{{ $column }}" value="{{ $value }}"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
      @endforeach

      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Save
      </button>
    </form>
  </x-layout>
