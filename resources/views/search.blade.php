<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto">
        <h1 class="text-2xl mb-4">
            You searched for <strong>{{ $query }}</strong>
        </h1>
        <div class="grid gap-x-7 gap-y-4 grid-cols-3">
            @foreach($results as $video)
                <livewire:video-card :video="$video" :key="$video->id"/>
            @endforeach
        </div>
    </div>
</x-app-layout>
