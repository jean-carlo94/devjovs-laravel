<div class="flex flex-col items-center justify-center p-5 mt-10 bg-gray-100 ">
    <h3 class="my-4 text-2xl font-bold text-center">Postularme a esta vacante</h3>

    @if(session()->has('message'))
        <p class="p-2 my-5 font-bold text-green-600 uppercase bg-green-100 border border-green-600 rounded-lg">
            {{ session('message') }}
        </p>
    @else
        <form wire:submit.prevent='apply' class="mt-5 w-96">
            <div class="mb-4">
                <x-input-label for="cv" :value="__('Curriculum o Hoja de Vida (PDF)')" />
                <x-text-input
                    id="cv"
                    type="file"
                    wire:model="cv"
                    required
                    accept=".pdf"
                    class="block w-full text-sm text-indigo-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100"
                />
                @error('cv')
                    <x-input-error :messages="$message" />
                @enderror

                <x-primary-button class="my-5">
                    {{__('Postularme')}}
                </x-primary-button>
            </div>
        </form>
    @endif

</div>
