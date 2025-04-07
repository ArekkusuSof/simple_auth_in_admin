<x-layout>
    <div class="min-h-screen flex max-w-screen-xl mx-auto overflow-hidden">
      <!-- Ліва колонка: відображення даних таблиці -->
      <div class="flex-1 p-2 overflow-x-auto">
        <x-slot:heading>
          Admin Panel ({{ auth()->user()->name }}) - {{ $table ? ucfirst($table) : 'Overview' }}
        </x-slot:heading>

        @if($table)
          <h2 class="mb-4 text-lg font-semibold">{{ ucfirst($table) }} Table</h2>
          <div class="overflow-x-auto">
            <table class="min-w-full table-auto divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  @if($data && $data->isNotEmpty())
                    @foreach(array_keys((array)$data->first()) as $column)
                      <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ $column }}
                      </th>
                    @endforeach
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Actions
                    </th>
                  @elseif(!empty($columns))
                    @foreach($columns as $column)
                      <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ $column }}
                      </th>
                    @endforeach
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Actions
                    </th>
                  @else
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      No columns
                    </th>
                  @endif
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @if($data && $data->isNotEmpty())
                  @foreach($data as $row)
                    <tr>
                      @foreach((array)$row as $value)
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">
                          {{ $value }}
                        </td>
                      @endforeach
                      <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">
                        <!-- Посилання для редагування -->
                        <a href="{{ route('admin.edit', ['table' => $table, 'id' => $row->id]) }}"
                           class="text-blue-600 hover:underline">Edit</a>
                        <!-- Форма для видалення -->
                        <form action="{{ route('admin.destroy', ['table' => $table, 'id' => $row->id]) }}"
                              method="POST" class="inline-block ml-2" onsubmit="return confirm('Are you sure you want to delete this record?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="text-red-600 hover:underline">
                            Delete
                          </button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td class="px-4 py-2 text-sm text-gray-500" colspan="{{ !empty($columns) ? count($columns) + 1 : 1 }}">
                      This table has no data.
                    </td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
        @else
          <p class="text-gray-600">Select a table from the right column to view data.</p>
        @endif
      </div>

      <!-- Права колонка: меню з таблицями -->
      <aside class="w-64 bg-white border-l border-gray-200 p-4 flex-shrink-0">
        <h2 class="text-xl font-semibold mb-4">Tables</h2>
        <ul class="space-y-2">
          @foreach($tables as $tbl)
            <li>
              <a href="{{ route('admin', ['table' => $tbl]) }}"
                 class="block text-blue-600 hover:underline {{ ($table === $tbl) ? 'font-bold' : '' }}">
                {{ ucfirst($tbl) }}
              </a>
            </li>
          @endforeach
        </ul>
      </aside>
    </div>
  </x-layout>
