                <x-sweet.modal title="Detail Todo: {{ $todo['title'] ?? 'Sample Todo' }}"
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
                                    {{ ($todo['status'] ?? 'pending') === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    <i
                                        class="fas {{ ($todo['status'] ?? 'pending') === 'completed' ? 'fa-check-circle' : 'fa-clock' }} mr-2"></i>
                                    {{ ucfirst($todo['status'] ?? 'pending') }}
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
                                    Status
                                </h5>
                                <p class="text-purple-700">{{ ucfirst($todo['status'] ?? 'pending') }}</p>
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
                </x-sweet.modal>
