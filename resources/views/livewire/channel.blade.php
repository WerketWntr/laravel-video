<div>
    <div class="flex">
        @if(auth()->check() && $channel->id === auth()->user()->id)
            <x-form wire:submit="updatedBanner">
                <x-file wire:model="banner">
                    <img src="{{ $channel->banner_image ?? 'banner-placeholder.png' }}"
                         alt="{{ $channel->name }}'s profile picture"/>
                </x-file>
            </x-form>
        @else
            <img src="{{ $channel->banner_image ?? 'banner-placeholder.png'}}"
                 alt="{{ $channel->name }}'s profile picture"/>
        @endif
        <x-form wire:submit="updatedBanner">
            <x-file wire:model="banner">
                <img src="/{{$channel->banner_image ?? 'banner-placeholder.png'}}"/>
            </x-file>
        </x-form>
    </div>
    <div class="flex justify-between">
        <div class="flex">
            <img src="{{ $channel->profile_photo_url }}" alt="{{ $channel->name }}'s profile picture"
                 class="rounded-full z-50 mt-[-15px] shadow-sm border-slate-300 w-24"/>
            <div class="ml-2">
                <h1 class="font-bold text-2xl">{{ $channel->name }}</h1>
                <p>
                    <span class="border-l-2 h-4 border-gray-300 nl-3 mr-2"/>
                    <span>
                        {{ Number::abbreviate($channel->subscribers()->count()) }} {{ Str::plural('subscriber', $channel->subscribers->count()) }}
                    </span>
                    <span class="border-l-2 h-4 border-gray-300 nl-3 mr-2"/>
                    <span>
                        {{ Number::abbreviate($channel->totalViews()) }} {{ Str::plural('views', $channel->totalViews()) }}
                    </span>
                </p>
                <div>
                    @auth
                        @if($channel->id !== auth()->user()->id)
                            @if(auth()->user()->isSubscribedToUser($channel))
                                <x-button wire:click="toggleSubscriber"
                                          class="text-white hover:bg-black bg-red-600 btn-sm">
                                    Subscribed
                                </x-button>
                            @else
                                <x-button wire:click="toggleSubscriber"
                                          class="text-white bg-black hover:bg-red-600 btn-sm">
                                    Subscribe
                                </x-button>
                            @endif
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        <div class="mt-3">
            @auth

                @if($channel->id === auth()->user()->id)
                    <x-button wire:click="toggleEdit" class="btn-sm btn-outline">
                        Customize Channel
                    </x-button>
                @endif

            @endauth
        </div>
    </div>
    <div class="mt-5">
        <x-tabs selected="home">
            <x-tab name="home" label="Home">
                <div>Home</div>
            </x-tab>
            <x-tab name="videos" label="Videos">
                <div class="grid gap-x-8 gap-y-4 grid-cols-3">
                    @foreach($channel->videos as $video)
                        <livewire:video-card lazy :video="$video" wire:key="$video->id"/>
                    @endforeach
                </div>
            </x-tab>
            <x-tab name="about" label="About">
                @if(!$this->customize)
                    <div class="bg-slate-200 p-6 rounded-sm">
                        {{ $channel->description }}
                    </div>
                @elseif($channel->id === auth()->user()->id)
                    <x-form wire:submit.prevent="updateChannel">
                        <x-textarea wire:model="about" name="about" rows="5"/>
                        <x-button type="submit" class="btn-sm w-24 btn-outline">
                            Save
                        </x-button>
                    </x-form>
                @endif
                <div class="flex">
                    <x-stat
                        title="Total Views"
                        value="{{ $channel->totalViews() }}"/>
                    <x-stat
                        title="Total Subscribers"
                        value="{{ $channel->subscribers->count() }}"/>
                    <x-stat
                        title="Total Videos"
                        value="{{ $channel->videos->count()}}"/>
                </div>
            </x-tab>
        </x-tabs>
    </div>
</div>
