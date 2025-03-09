<?php
namespace App\Livewire;

use Livewire\Component;

class DownloadModal extends Component
{
    public $showModal = false;
    public $startDate;
    public $endDate;

    protected $listeners = ['openDownloadModal' => 'show']; // Menerima event

    public function show()
    {
        $this->showModal = true;
    }

    public function hide()
    {
        $this->showModal = false;
    }

    public function downloadData()
    {
        // Logika unduh data
        session()->flash('message', 'Data berhasil diunduh!');
        $this->hide();
    }

    public function render()
    {
        return view('livewire.download-modal');
    }
}
