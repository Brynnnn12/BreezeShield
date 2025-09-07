                <x-sweet-confirm title="Delete Todo?"
                    text="Apakah Anda yakin ingin menghapus todo ini? Aksi ini tidak bisa dibatalkan!"
                    confirm-text="Ya, hapus!" cancel-text="Batal" icon="warning"
                    action="{{ route('todos.destroy', $todo['id'] ?? 1) }}" method="DELETE" :params="['id' => $todo['id'] ?? 1]" />
