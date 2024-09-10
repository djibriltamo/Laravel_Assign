
<div class="inline-block relative" x-data="{open: true}">

    <input @click.away="open = false; @this.resetIndex();" @click="open = true" wire:model.live="search" 
        class="bg-gray-200 text-gray-700 border-2 focus:outline-none placeholder-gray-500 px-6 py-1 rounded-full mr-3 w-56" 
        placeholder="Rechercher une mission..." wire:keydown.arrow-down.prevent="incrementIndex()" wire:keydown.arrow-up.prevent="decrementIndex()"
        wire:keydown.backspace="resetIndex()" wire:keydown.enter.prevent="showJob()"
    >

    <svg class="w-5 h-5 text-gray-500 absolute top-0 right-0 mt-2 mr-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
    </svg>

    @if ($search)
    <div class="z-10 bg-white border border-gray-400 rounded w-56 px-2 py-1 mt-10 flex flex-col absolute" x-show="open">
                <div>
                    @if (count($jobs) > 0)

                        @foreach ($jobs as $index => $job)
                            <p class="p-1 {{ $index === $selectIndex ? 'text-green-500' : '' }}">{{ $job->title }}</p>
                        @endforeach
                        
                    @else
                        <span class="text-red-700 p-1">0 résultats pour {{ $search }}</span>
                    @endif
                </div>
        </div>
    @endif

</div>
