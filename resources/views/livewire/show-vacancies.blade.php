<div>
    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        @forelse ( $vacancies as $vacancy )
            <div class="p-6 bg-white border-b border-gay-200 md:flex md:justify-between md:items-center">
                <div class="space-y-3">
                    <a href="{{ route('vacancies.show', $vacancy->id) }}" class="text-xl font-bold">
                        {{ $vacancy->title }}
                    </a>
                    <p class="text-sm font-bold text-gray-600">{{ $vacancy->business }}</p>
                    <p class="text-sm text-gray-500">Ultimo dia de aplicación: {{ $vacancy->last_day->format('d/m/Y') }}</p>
                </div>

                <div class="flex flex-col items-stretch gap-3 mt-5 md:flex-row md:mt-0">
                    <a
                        href="{{ route('candidates.index', $vacancy) }}"
                        class="px-4 py-2 text-xs font-bold text-center text-white uppercase rounded-lg bg-slate-800"
                    >
                        {{ $vacancy->candidates->count() }}
                        Candidatos
                    </a>

                    <a
                        href="{{ route('vacancies.edit', $vacancy->id) }}"
                        class="px-4 py-2 text-xs font-bold text-center text-white uppercase bg-blue-800 rounded-lg"
                    >
                        Editar
                    </a>

                    <button
                        wire:click="$dispatch('showAlert', {vacancy:{{ $vacancy }} })"
                        class="px-4 py-2 text-xs font-bold text-center text-white uppercase bg-red-800 rounded-lg"
                    >
                        Eliminar
                    </button>
                </div>
            </div>
        @empty
            <p class="p-3 text-sm text-center text-gray-600">No hay vacantes para mostrar. </p>
        @endforelse

    </div>

    <div class="p-5 mt-10">
        {{ $vacancies->links() }}
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('showAlert', (vacancy) => {
                Swal.fire({
                title: "¿Eliminar Vacante?",
                text: "Una vacante eliminada no se puede recuperar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, ¡Eliminar!",
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                    if (result.isConfirmed) {
                        @this.dispatch('deleteVacancy', vacancy);

                        Swal.fire({
                        title: "Se elimino la vacante!",
                        text: "Eliminado Correctamente.",
                        icon: "success"
                        });
                    }
                });
            });
        });
    </script>
@endpush
