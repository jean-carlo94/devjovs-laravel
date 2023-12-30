<form class="space-y-5 md:w-1/2" wire:submit.prevent="editVacancy">
    <div>
        <x-input-label for="title" :value="__('Titulo')" />
        <x-text-input
            id="title"
            class="block w-full mt-1"
            type="text"
            wire:model="title"
            :value="old('title')"
            autofocus
            required
            autocomplete="title"
            placeholder="Titulo Vacante"
        />
        @error('title')
            <x-input-error :messages="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="wage_id" :value="__('Salario Mensual')" />
        <select
            id="wage_id"
            wire:model="wage_id"
            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            value="{{ old('wage_id') }}"
        >
            <option value="">-- Seleccione --</option>
            @foreach ($wages as $wage)
                <option value="{{ $wage->id }}">{{ $wage->wage }}</option>
            @endforeach
        </select>
        @error('wage_id')
            <x-input-error :messages="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="category_id" :value="__('Categoría')" />
            <select
                id="category_id"
                wire:model="category_id"
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                value="{{ old('category_id') }}"
            >
                    <option value="">-- Seleccione --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                @endforeach
        </select>
        @error('category_id')
            <x-input-error :messages="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="business" :value="__('Empresa')" />
        <x-text-input
            id="business"
            class="block w-full mt-1"
            type="text"
            wire:model="business"
            :value="old('business')"
            autofocus
            required
            autocomplete="business"
            placeholder="Empresa: Ej, Netflix, Uber, Shopify"
        />
        @error('business')
            <x-input-error :messages="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="last_day" :value="__('Ultimo dia para postularse')" />
        <x-text-input
            id="last_day"
            class="block w-full mt-1"
            type="date"
            wire:model="last_day"
            :value="old('last_day')"
            autofocus
            required
            autocomplete="last_day"
        />
        @error('last_day')
            <x-input-error :messages="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="description" :value="__('Descripción')" />
        <textarea
            wire:model="description"
            placeholder="Descripción general del puesto, experiencia"
            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 h-72"
        ></textarea>

        @error('description')
            <x-input-error :messages="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="new_image" :value="__('Imagen')" />
        <x-text-input
            id="new_image"
            type="file"
            wire:model="new_image"
            accept="image/*"
            autofocus
            class="block w-full text-sm text-indigo-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100"
        />

        <div class="flex flex-col items-center justify-center w-full gap-2 my-5">
            @if ( $new_image )
                <x-input-label :value="__('Nueva Imagen')" />
                <img class="w-1/2" src="{{ $new_image->temporaryUrl() }}" alt="{{ 'Nueva Imagen Vacante ' . $title }}" >
                @error('new_image')
                    <x-input-error :messages="$message" />
                @enderror
            @else
                <x-input-label :value="__('Imagen Actual')" />
                <img class="w-1/2" src="{{ asset('storage/vacancies/'.$image) }}" alt="{{ 'Imagen Vacante ' . $title }}" >
            @endif
        </div>

    </div>

    <div class="flex justify-end mt-10">
        <x-primary-button>
            Guardar Cambios
        </x-primary-button>
    </div>
</form>
