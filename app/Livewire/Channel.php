<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

class Channel extends Component
{
    use Toast;
    use WithFileUploads;

    public User $channel;
    public $about;
    public $banner;

    public bool $customize = false;

    public function render()
    {
        return view('livewire.channel');
    }

    public function toggleSubscriber()
    {
        $this->channel->subscribers()->toggle(auth()->user());
    }

    public function updateChannel(): void
    {
        if ($this->channel->id !== auth()->user()->id) {
            return;
        }

        $this->channel->update([
            'description' => $this->about,
        ]);

        $this->customize = false;
        $this->channel->refresh();
        $this->toast(title: 'Channel Updated', description: 'Ypur channel has been updated', type: 'success');
    }

    public function toggleEdit(): void
    {
        $this->customize = !$this->customize;
    }

    #[On('updatedBanner')]
    public function updatedBanner()
    {
        auth()->user()->update([
            'banner_image' => $this->baner->storeAs('banner-images', Str::uuid() . '.' , [
        'disk' => 'public',
    ])
        ]);
    }
}
