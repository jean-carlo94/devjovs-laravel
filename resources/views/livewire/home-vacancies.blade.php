<div>

    <livewire:search-vacancies>

   <div class="py-12">
        <div class="mx-auto max-w-7xl">
            <h3 class="mb-12 text-4xl font-extrabold text-gray-700">Nuestras Vacantes Disponibles</h3>

            <div class="p-6 bg-white divide-y divide-gray-200 rounded-lg shadow-sm">
                @forelse ($vacancies as $vacancy)
                    <div class="py-5 md:flex md:justify-center md:items-center">
                        <div class="md:flex-1">
                            <a
                                class="text-3xl font-extrabold text-gray-600"
                                href={{ route('vacancies.show', $vacancy->id) }}
                            >{{ $vacancy->title }}</a>
                            <p class="text-base">Empresa: <span class="font-bold">{{ $vacancy->business }}</span></p>
                            <p class="text-xs font-bold text-gray-600">{{ $vacancy->category->category }}</p>
                            <p class="text-xs font-bold text-gray-600">{{ $vacancy->wage->wage }}</p>
                            <p class="mb-1 text-xs font-bold text-gray-600">Ultimó dia para postularse:
                                <span class="font-normal">{{ $vacancy->last_day->format('d/m/y') }}</span>
                            </p>
                        </div>
                        <div class="mt-5 md:mt-0">
                            <a
                                class="block p-3 font-bold text-center text-white uppercase bg-indigo-500 rounded-lg"
                                href={{ route('vacancies.show', $vacancy->id) }}
                            >Ver Vacante</a>
                        </div>
                    </div>
                @empty
                    <p class="p-3 text-sm text-center text-gray-600">No hay vacantes aun</p>
                @endforelse
            </div>
        </div>
   </div>
</div>
