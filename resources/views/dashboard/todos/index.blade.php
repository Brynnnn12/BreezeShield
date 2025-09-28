<x-layout.dashboard title="Manajemen Todos">
    <!-- Flash Messages -->
    <x-flash-messages />


    <x-card>
        <x-slot name="header">
            <h3 class="text-lg font-semibold text-gray-800">Manajemen Todos</h3>
            <x-button variant="primary" icon="fas fa-plus" onclick="location.href='{{ route('todos.create') }}'">
                Tambah Todo
            </x-button>
        </x-slot>

        <!-- Search Bar -->
        <div class="mb-6">
            <x-input name="search" placeholder="Cari berdasarkan title atau description..." icon="fas fa-search" />
        </div>

        <!-- Todos Table -->
        <x-table :headers="['Title', 'Description', 'completed', 'Created', 'Actions']" striped hover>
            @forelse($todos ?? [] as $todo)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $todo['title'] ?? 'Sample Todo' }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-500">
                            {{ Str::limit($todo['description'] ?? 'Sample description for todo item', 50) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                            {{ ($todo['completed'] ?? '0') === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($todo['completed'] ?? '0') }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $todo['created_at'] ?? now()->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <x-button size="xs" variant="outline" icon="fas fa-eye"
                            onclick="showTodoModal{{ $todo['id'] ?? 1 }}()">
                            View
                        </x-button>
                        <x-button size="xs" variant="outline" icon="fas fa-edit"
                            onclick="location.href='{{ route('todos.edit', $todo['id'] ?? 1) }}'">
                            Edit
                        </x-button>
                        <x-button size="xs" variant="danger" icon="fas fa-trash"
                            onclick="sweetConfirm{{ $todo['id'] ?? 1 }}()">
                            Delete
                        </x-button>
                    </td>
                </tr>

                <!-- Generate sweet-confirm for each todo -->
                <x-sweet-confirm title="Delete Todo?"
                    text="Apakah Anda yakin ingin menghapus todo ini? Aksi ini tidak bisa dibatalkan!"
                    confirm-text="Ya, hapus!" cancel-text="Batal" icon="warning"
                    action="{{ route('todos.destroy', $todo['id'] ?? 1) }}" method="DELETE" :params="['id' => $todo['id'] ?? 1]" />

                <!-- Generate sweet-modal for viewing todo details -->
                <x-sweet-modal title="Detail Todo: {{ $todo['title'] ?? 'Sample Todo' }}"
                    function-name="showTodoModal{{ $todo['id'] ?? 1 }}" width="600" :show-cancel-button="false"
                    confirm-text="Tutup">
                    <div class="space-y-6">
                        <!-- Todo Header -->
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                {{ $todo['title'] ?? 'Sample Todo' }}
                            </h3>
                            <div class="flex items-center space-x-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    {{ ($todo['completed'] ?? '0') === '1' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    <i
                                        class="fas {{ ($todo['completed'] ?? '0') === '1' ? 'fa-check-circle' : 'fa-clock' }} mr-2"></i>
                                    {{ ucfirst($todo['completed'] ?? '0') }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    Dibuat: {{ $todo['created_at'] ?? now()->format('d M Y') }}
                                </span>
                            </div>
                        </div>

                        <!-- Todo Description -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-900 mb-2">
                                <i class="fas fa-align-left mr-2"></i>
                                Deskripsi
                            </h4>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700 leading-relaxed">
                                    {{ $todo['description'] ?? 'Sample description for todo item. This is a longer description to show how the modal handles more content.' }}
                                </p>
                            </div>
                        </div>

                        <!-- Todo Meta Information -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-blue-50 rounded-lg p-4">
                                <h5 class="text-sm font-medium text-blue-900 mb-1">
                                    <i class="fas fa-hashtag mr-1"></i>
                                    ID Todo
                                </h5>
                                <p class="text-blue-700">#{{ $todo['id'] ?? 1 }}</p>
                            </div>
                            <div class="bg-purple-50 rounded-lg p-4">
                                <h5 class="text-sm font-medium text-purple-900 mb-1">
                                    <i class="fas fa-clock mr-1"></i>
                                    completed
                                </h5>
                                <p class="text-purple-700">{{ ucfirst($todo['completed'] ?? '0') }}</p>
                            </div>
                        </div>

                        <!-- Action Buttons in Modal -->
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex space-x-3 justify-center">
                                <button onclick="location.href='{{ route('todos.edit', $todo['id'] ?? 1) }}'"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit Todo
                                </button>
                                <button onclick="Swal.close(); sweetConfirm{{ $todo['id'] ?? 1 }}()"
                                    class="inline-flex items-center px-4 py-2 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <i class="fas fa-trash mr-2"></i>
                                    Hapus Todo
                                </button>
                            </div>
                        </div>
                    </div>
                </x-sweet-modal>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="text-gray-500">
                            <i class="fas fa-clipboard-list text-4xl mb-4"></i>
                            <p class="text-lg font-medium">No todos found</p>
                            <p class="mt-2">Get started by creating your first todo.</p>
                            <x-button variant="primary" icon="fas fa-plus" class="mt-4"
                                onclick="location.href='{{ route('todos.create') }}'">
                                Create Todo
                            </x-button>
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-table>

        @if (!empty($todos))
            <x-slot name="footer">
                <!-- Pagination will be added here when using real data -->
                <div class="text-sm text-gray-700">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">1</span> of <span
                        class="font-medium">1</span> results
                </div>
            </x-slot>
        @endif

    </x-card>
</x-layout.dashboard>
