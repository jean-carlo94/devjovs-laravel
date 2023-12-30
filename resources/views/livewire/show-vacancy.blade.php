<div class="p-10">
    <div class="mb-5">
        <h3 class="my-3 text-3xl text-gray-800 fond-bold">
            {{ $vacancy->title }}
        </h3>

        <div class="p-4 my-10 md:grid md:grid-cols-2 bg-gray-50">
            <p class="my-3 text-sm font-bold text-gray-800 uppercase">Empresa:
                <span class="font-normal normal-case">{{ $vacancy->business }}</span>
            </p>

            <p class="my-3 text-sm font-bold text-gray-800 uppercase">Ultimo dia para postularse:
                <span class="font-normal normal-case">{{ $vacancy->last_day->toFormattedDateString() }}</span>
            </p>

            <p class="my-3 text-sm font-bold text-gray-800 uppercase">Categoría:
                <span class="font-normal normal-case">{{ $vacancy->category->category }}</span>
            </p>

            <p class="my-3 text-sm font-bold text-gray-800 uppercase">Salario:
                <span class="font-normal normal-case">{{ $vacancy->wage->wage }}</span>
            </p>
        </div>
    </div>
    <div class="gap-4 md:grid md:grid-cols-6">
        <div class="md:col-span-2">
            <img src="{{ asset('storage/vacancies/'.$vacancy->image) }}" alt="{{ 'Imagen vacante ' . $vacancy->title}}">
        </div>
        <div class="md:col-span-4">
            <h2 class="mb-5 text-2xl font-bold">Descripción de la vacante</h2>
            <p>{{ $vacancy->description }}</p>
        </div>
    </div>

    @guest
        <div class="p-5 mt-5 text-center border-dashed bg-gray-50">
            <p>
                ¿Deseas aplicar a esta vacante? <a class="font-bold text-indigo-600" href="{{ route('register') }}">Obtén una cuenta y aplica a esta y otras vacantes</a>
            </p>
        </div>
    @endguest

    @cannot('create', App\Models\Vacancy::class)
        <livewire:apply-vacancy :vacancy="$vacancy" />
    @endcannot
</div>
