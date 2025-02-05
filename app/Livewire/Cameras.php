<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Camera;

class Cameras extends Component
{
    // Tambahkan variabel tambahan untuk form
    public $newCameraName = '';
    public $newCameraUrl = '';
    public $newCameraResolution = '1080p';
    public $newCameraStatus = true;
    public $newCameraLocation = '';

    // Variabel untuk edit
    public $editCameraId = null;
    public $editCameraName = '';
    public $editCameraUrl = '';
    public $editCameraResolution = '1080p';
    public $editCameraStatus = true;
    public $editCameraLocation = '';

    public $cameras = [];

    public function mount()
    {
        // Ambil data dari tabel cameras
        $this->cameras = Camera::all()->toArray();
        //  // Data dummy untuk cameras dengan tambahan informasi
        // $this->cameras = [
        //     [
        //         'id' => 1,
        //         'name' => 'Sedayu, DIY',
        //         'url' => 'https://example.com/camera1',
        //         'thumbnail_url' => 'https://via.placeholder.com/400x300',
        //         'location' => 'Pintu Masuk Utama',
        //         'resolution' => '1080p',
        //         'status' => true
        //     ],
        //     [
        //         'id' => 2,
        //         'name' => 'Bonbin, BDG',
        //         'url' => 'https://example.com/camera2',
        //         'thumbnail_url' => 'https://via.placeholder.com/400x300',
        //         'location' => 'Area Parkir Belakang',
        //         'resolution' => '720p',
        //         'status' => false
        //     ],
        //     [
        //         'id' => 3,
        //         'name' => 'Samirono, DIY',
        //         'url' => 'https://example.com/camera3',
        //         'thumbnail_url' => 'https://via.placeholder.com/400x300',
        //         'location' => 'Ruang Penyimpanan',
        //         'resolution' => '4K',
        //         'status' => true
        //     ]
        // ];
    }

    public function addCamera()
    {
        $this->validate([
            'newCameraName' => 'required|string|max:255',
            'newCameraUrl' => 'required|string|max:255',
            'newCameraLocation' => 'required|string|max:255',
            'newCameraResolution' => 'required|in:720p,1080p,4K',
        ]);

        Camera::create([
            'name' => $this->newCameraName,
            'url' => $this->newCameraUrl,
            'thumbnail_url' => 'https://via.placeholder.com/400x300',
            'location' => $this->newCameraLocation,
            'resolution' => $this->newCameraResolution,
            'status' => $this->newCameraStatus
        ]);

        // Ambil data terbaru dari database
        $this->cameras = Camera::all()->toArray();

        $this->reset(['newCameraName', 'newCameraUrl', 'newCameraLocation', 'newCameraResolution', 'newCameraStatus']);
        
        $this->dispatch('close-modal');
        session()->flash('success', 'Kamera berhasil ditambahkan!');
    }

    public function editCamera($id)
    {
        $camera = collect($this->cameras)->firstWhere('id', $id);
        
        if ($camera) {
            $this->editCameraId = $id;
            $this->editCameraName = $camera['name'];
            $this->editCameraUrl = $camera['url'];
            $this->editCameraResolution = $camera['resolution'];
            $this->editCameraStatus = $camera['status'];
            $this->editCameraLocation = $camera['location'];
        }
    }

    public function updateCamera()
    {
        $this->validate([
            'editCameraName' => 'required|string|max:255',
            'editCameraUrl' => 'required|string|max:255',
            'editCameraLocation' => 'required|string|max:255',
            'editCameraResolution' => 'required|in:720p,1080p,4K',
        ]);

        $camera = Camera::find($this->editCameraId);
        if ($camera) {
            $camera->update([
                'name' => $this->editCameraName,
                'url' => $this->editCameraUrl,
                'location' => $this->editCameraLocation,
                'resolution' => $this->editCameraResolution,
                'status' => $this->editCameraStatus,
            ]);
        }

        // Ambil data terbaru dari database
        $this->cameras = Camera::all()->toArray();

        $this->reset(['editCameraId', 'editCameraName', 'editCameraUrl', 'editCameraLocation', 'editCameraResolution', 'editCameraStatus']);
        
        $this->dispatch('close-modal');
        session()->flash('success', 'Kamera berhasil diperbarui!');
    }

    public function deleteCamera($id)
    {
        $camera = Camera::find($id);
        if ($camera) {
            $camera->delete();
        }

        $this->cameras = array_filter($this->cameras, function($camera) use ($id) {
            return $camera['id'] != $id;
        });

        $this->dispatch('close-modal');
        session()->flash('success', 'Kamera berhasil dihapus!');
    }

    public function createCamera($data)
    {
        $this->validate([
            'data.name' => 'required|string|max:255',
            'data.url' => 'required|string|max:255',
            'data.resolution' => 'required|in:720p,1080p,4K',
        ]);

        $this->cameras[] = [
            'id' => count($this->cameras) + 1,
            'name' => $data['name'],
            'url' => $data['url'],
            'thumbnail_url' => 'https://via.placeholder.com/400x300',
            'location' => $data['url'],
            'resolution' => $data['resolution'],
            'status' => $data['status'] ?? true
        ];

        session()->flash('success', 'Kamera berhasil ditambahkan!');
    }

    public function updateCameraById($id, $data)
    {
        $this->validate([
            'data.name' => 'required|string|max:255',
            'data.url' => 'required|string|max:255',
            'data.resolution' => 'required|in:720p,1080p,4K',
        ]);

        foreach ($this->cameras as &$camera) {
            if ($camera['id'] == $id) {
                $camera['name'] = $data['name'];
                $camera['url'] = $data['url'];
                $camera['resolution'] = $data['resolution'];
                $camera['status'] = $data['status'] ?? true;
                break;
            }
        }

        session()->flash('success', 'Kamera berhasil diperbarui!');
    }

    public function deleteCameraById($id)
    {
        $this->cameras = array_filter($this->cameras, function($camera) use ($id) {
            return $camera['id'] != $id;
        });

        session()->flash('success', 'Kamera berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.cameras');
    }
}