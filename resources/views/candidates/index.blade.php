<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Candidatos Vacante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="my-5 text-2xl font-bold text-center">Candidatos Vacante: {{ $vacancy->title }}</h1>

                    <div class="p-5 md:flex md:justify-center">
                        <ul class="w-full divide-y divide-gray-200">
                            @forelse ($vacancy->candidates as $candidate)
                                <li class="flex items-center p-3">
                                    <div class="flex-1">
                                        <p class="text-xl font-medium text-gray-800">{{ $candidate->user->name }}</p>
                                        <p class="text-sm font-medium text-gray-600">{{ $candidate->user->email }}</p>
                                        <p class="text-sm font-medium text-gray-600"> Dia que se postulo:
                                            <span class="font-normal">{{ $candidate->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                    <div>
                                        <a class="inline-flex items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50"
                                            href="{{ asset('storage/cv/' . $candidate->cv ) }}"
                                            target="_blank"
                                            rel="noreferrer noopener"
                                        >Ver CV</a>
                                    </div>
                                </li>
                            @empty
                                <p class="p-3 text-sm text-center text-gray-600">No hay candidatos aún</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
