<?php

namespace App\Livewire;

use App\Models\ArusLaluLintasBarat;
use App\Models\Intersection;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\Simpang;
use App\Models\ArusLaluLintasSelatan;
use App\Models\ArusLaluLintasTimur;
use App\Models\ArusLaluLintasUtara;

class Intersections extends Component
{
    use WithPagination;
    #[Url]
    public $search = '';

    public $mode = 'list';
    public $simpang_id;
    public $Nama_Simpang = '';
    public $Kota = '';
    public $Ukuran_Kota = '';
    public $Tanggal;
    public $Periode = '';
    public $Ditangani_Oleh = '';
    public $selectedIntersection = null;

    protected $rules = [
        'Nama_Simpang' => 'required|min:3',
        'Kota' => 'required',
        'Ukuran_Kota' => 'nullable',
        'Tanggal' => 'nullable|date',
        'Periode' => 'nullable',
        'Ditangani_Oleh' => 'nullable'
    ];

    public function getCombinedData()
    {
        $combinedData = collect();

        $combinedData = $combinedData->merge(ArusLaluLintasBarat::all());
        $combinedData = $combinedData->merge(ArusLaluLintasSelatan::all());
        $combinedData = $combinedData->merge(ArusLaluLintasTimur::all());
        $combinedData = $combinedData->merge(ArusLaluLintasUtara::all());

        $groupedData = $combinedData->groupBy('Arah')->map(function ($group) {
            return (object) [
                'MC' => $group->sum('MC'),
                'LV' => $group->sum('LV'),
                'HV' => $group->sum('HV'),
                'UM' => $group->sum('UM'),
            ];
        });

        return $groupedData;
    }

    public function getDirectionLabels($direction)
    {
        switch ($direction) {
            case 'Barat':
                return [
                    'Belok Kiri' => 'Selatan',
                    'Jalan Lurus' => 'Timur',
                    'Belok Kanan' => 'Utara',
                ];
            case 'Selatan':
                return [
                    'Belok Kiri' => 'Timur',
                    'Jalan Lurus' => 'Utara',
                    'Belok Kanan' => 'Barat',
                ];
            case 'Timur':
                return [
                    'Belok Kiri' => 'Utara',
                    'Jalan Lurus' => 'Barat',
                    'Belok Kanan' => 'Selatan',
                ];
            case 'Utara':
                return [
                    'Belok Kiri' => 'Barat',
                    'Jalan Lurus' => 'Selatan',
                    'Belok Kanan' => 'Timur',
                ];
            default:
                return [];
        }
    }

    public function getInOutData()
    {
        $directions = ['Barat', 'Selatan', 'Timur', 'Utara'];
        $inOutData = [];

        foreach ($directions as $direction) {
            $inData = [
                'MC' => 0,
                'LV' => 0,
                'HV' => 0,
                'UM' => 0
            ];

            switch ($direction) {
                case 'Barat':
                    // Get incoming traffic to Barat from other directions
                    $inData['MC'] =
                        ArusLaluLintasSelatan::where('Arah', 'Barat')->sum('MC') +
                        ArusLaluLintasTimur::where('Arah', 'Barat')->sum('MC') +
                        ArusLaluLintasUtara::where('Arah', 'Barat')->sum('MC');
                    $inData['LV'] =
                        ArusLaluLintasSelatan::where('Arah', 'Barat')->sum('LV') +
                        ArusLaluLintasTimur::where('Arah', 'Barat')->sum('LV') +
                        ArusLaluLintasUtara::where('Arah', 'Barat')->sum('LV');
                    $inData['HV'] =
                        ArusLaluLintasSelatan::where('Arah', 'Barat')->sum('HV') +
                        ArusLaluLintasTimur::where('Arah', 'Barat')->sum('HV') +
                        ArusLaluLintasUtara::where('Arah', 'Barat')->sum('HV');
                    $inData['UM'] =
                        ArusLaluLintasSelatan::where('Arah', 'Barat')->sum('UM') +
                        ArusLaluLintasTimur::where('Arah', 'Barat')->sum('UM') +
                        ArusLaluLintasUtara::where('Arah', 'Barat')->sum('UM');

                    $outData = [
                        'MC' => ArusLaluLintasBarat::sum('MC'),
                        'LV' => ArusLaluLintasBarat::sum('LV'),
                        'HV' => ArusLaluLintasBarat::sum('HV'),
                        'UM' => ArusLaluLintasBarat::sum('UM')
                    ];
                    break;

                    // Similar pattern for other directions
                case 'Selatan':
                    // Debug: Log each component separately
                    $fromBarat = ArusLaluLintasBarat::where('Arah', 'Selatan')->sum('MC');
                    $fromTimur = ArusLaluLintasTimur::where('Arah', 'Selatan')->sum('MC');
                    $fromUtara = ArusLaluLintasUtara::where('Arah', 'Selatan')->sum('MC');

                    \Log::info("Incoming MC to Selatan:", [
                        'from_barat' => $fromBarat,
                        'from_timur' => $fromTimur,
                        'from_utara' => $fromUtara,
                        'total' => $fromBarat + $fromTimur + $fromUtara
                    ]);

                    $inData['MC'] = $fromBarat + $fromTimur + $fromUtara;

                    // Similar debug for LV
                    $fromBaratLV = ArusLaluLintasBarat::where('Arah', 'Selatan')->sum('LV');
                    $fromTimurLV = ArusLaluLintasTimur::where('Arah', 'Selatan')->sum('LV');
                    $fromUtaraLV = ArusLaluLintasUtara::where('Arah', 'Selatan')->sum('LV');

                    \Log::info("Incoming LV to Selatan:", [
                        'from_barat' => $fromBaratLV,
                        'from_timur' => $fromTimurLV,
                        'from_utara' => $fromUtaraLV,
                        'total' => $fromBaratLV + $fromTimurLV + $fromUtaraLV
                    ]);

                    $inData['LV'] = $fromBaratLV + $fromTimurLV + $fromUtaraLV;

                    // Similar debug for HV
                    $fromBaratHV = ArusLaluLintasBarat::where('Arah', 'Selatan')->sum('HV');
                    $fromTimurHV = ArusLaluLintasTimur::where('Arah', 'Selatan')->sum('HV');
                    $fromUtaraHV = ArusLaluLintasUtara::where('Arah', 'Selatan')->sum('HV');

                    \Log::info("Incoming HV to Selatan:", [
                        'from_barat' => $fromBaratHV,
                        'from_timur' => $fromTimurHV,
                        'from_utara' => $fromUtaraHV,
                        'total' => $fromBaratHV + $fromTimurHV + $fromUtaraHV
                    ]);

                    $inData['HV'] = $fromBaratHV + $fromTimurHV + $fromUtaraHV;

                    // Similar debug for UM
                    $fromBaratUM = ArusLaluLintasBarat::where('Arah', 'Selatan')->sum('UM');
                    $fromTimurUM = ArusLaluLintasTimur::where('Arah', 'Selatan')->sum('UM');
                    $fromUtaraUM = ArusLaluLintasUtara::where('Arah', 'Selatan')->sum('UM');

                    \Log::info("Incoming UM to Selatan:", [
                        'from_barat' => $fromBaratUM,
                        'from_timur' => $fromTimurUM,
                        'from_utara' => $fromUtaraUM,
                        'total' => $fromBaratUM + $fromTimurUM + $fromUtaraUM
                    ]);

                    $inData['UM'] = $fromBaratUM + $fromTimurUM + $fromUtaraUM;

                    // Debug outgoing traffic
                    \Log::info("Outgoing from Selatan:", [
                        'MC' => ArusLaluLintasSelatan::sum('MC'),
                        'LV' => ArusLaluLintasSelatan::sum('LV'),
                        'HV' => ArusLaluLintasSelatan::sum('HV'),
                        'UM' => ArusLaluLintasSelatan::sum('UM')
                    ]);

                    $outData = [
                        'MC' => ArusLaluLintasSelatan::sum('MC'),
                        'LV' => ArusLaluLintasSelatan::sum('LV'),
                        'HV' => ArusLaluLintasSelatan::sum('HV'),
                        'UM' => ArusLaluLintasSelatan::sum('UM')
                    ];
                    break;

                case 'Timur':
                    $inData['MC'] =
                        ArusLaluLintasBarat::where('Arah', 'Timur')->sum('MC') +
                        ArusLaluLintasSelatan::where('Arah', 'Timur')->sum('MC') +
                        ArusLaluLintasUtara::where('Arah', 'Timur')->sum('MC');
                    $inData['LV'] =
                        ArusLaluLintasBarat::where('Arah', 'Timur')->sum('LV') +
                        ArusLaluLintasSelatan::where('Arah', 'Timur')->sum('LV') +
                        ArusLaluLintasUtara::where('Arah', 'Timur')->sum('LV');
                    $inData['HV'] =
                        ArusLaluLintasBarat::where('Arah', 'Timur')->sum('HV') +
                        ArusLaluLintasSelatan::where('Arah', 'Timur')->sum('HV') +
                        ArusLaluLintasUtara::where('Arah', 'Timur')->sum('HV');
                    $inData['UM'] =
                        ArusLaluLintasBarat::where('Arah', 'Timur')->sum('UM') +
                        ArusLaluLintasSelatan::where('Arah', 'Timur')->sum('UM') +
                        ArusLaluLintasUtara::where('Arah', 'Timur')->sum('UM');

                    $outData = [
                        'MC' => ArusLaluLintasTimur::sum('MC'),
                        'LV' => ArusLaluLintasTimur::sum('LV'),
                        'HV' => ArusLaluLintasTimur::sum('HV'),
                        'UM' => ArusLaluLintasTimur::sum('UM')
                    ];
                    break;

                case 'Utara':
                    $inData['MC'] =
                        ArusLaluLintasBarat::where('Arah', 'Utara')->sum('MC') +
                        ArusLaluLintasSelatan::where('Arah', 'Utara')->sum('MC') +
                        ArusLaluLintasTimur::where('Arah', 'Utara')->sum('MC');
                    $inData['LV'] =
                        ArusLaluLintasBarat::where('Arah', 'Utara')->sum('LV') +
                        ArusLaluLintasSelatan::where('Arah', 'Utara')->sum('LV') +
                        ArusLaluLintasTimur::where('Arah', 'Utara')->sum('LV');
                    $inData['HV'] =
                        ArusLaluLintasBarat::where('Arah', 'Utara')->sum('HV') +
                        ArusLaluLintasSelatan::where('Arah', 'Utara')->sum('HV') +
                        ArusLaluLintasTimur::where('Arah', 'Utara')->sum('HV');
                    $inData['UM'] =
                        ArusLaluLintasBarat::where('Arah', 'Utara')->sum('UM') +
                        ArusLaluLintasSelatan::where('Arah', 'Utara')->sum('UM') +
                        ArusLaluLintasTimur::where('Arah', 'Utara')->sum('UM');

                    $outData = [
                        'MC' => ArusLaluLintasUtara::sum('MC'),
                        'LV' => ArusLaluLintasUtara::sum('LV'),
                        'HV' => ArusLaluLintasUtara::sum('HV'),
                        'UM' => ArusLaluLintasUtara::sum('UM')
                    ];
                    break;
            }

            $inOutData[$direction] = [
                'in' => (object) $inData,
                'out' => (object) $outData,
                'labels' => $this->getDirectionLabels($direction),
            ];
        }

        return $inOutData;
    }

    public function getBaratTrafficFlow()
    {
        // Left turn from West to South
        $belokKiri = [
            'arus' => 'Belok Kiri / Utara',
            'MC' => ArusLaluLintasBarat::where('Arah', 'selatan')->sum('MC'),
            'LV' => ArusLaluLintasBarat::where('Arah', 'selatan')->sum('LV'),
            'HV' => ArusLaluLintasBarat::where('Arah', 'selatan')->sum('HV'),
            'UM' => ArusLaluLintasBarat::where('Arah', 'selatan')->sum('UM'),
            'total' => ArusLaluLintasBarat::where('Arah', 'selatan')->count()
        ];

        // Straight from West to East
        $jalanLurus = [
            'arus' => 'Jalan Lurus / Timur',
            'MC' => ArusLaluLintasBarat::where('Arah', 'timur')->sum('MC'),
            'LV' => ArusLaluLintasBarat::where('Arah', 'timur')->sum('LV'),
            'HV' => ArusLaluLintasBarat::where('Arah', 'timur')->sum('HV'),
            'UM' => ArusLaluLintasBarat::where('Arah', 'timur')->sum('UM'),
            'total' => ArusLaluLintasBarat::where('Arah', 'timur')->count()
        ];

        // Right turn from West to North
        $belokKanan = [
            'arus' => 'Belok Kanan / Selatan',
            'MC' => ArusLaluLintasBarat::where('Arah', 'utara')->sum('MC'),
            'LV' => ArusLaluLintasBarat::where('Arah', 'utara')->sum('LV'),
            'HV' => ArusLaluLintasBarat::where('Arah', 'utara')->sum('HV'),
            'UM' => ArusLaluLintasBarat::where('Arah', 'utara')->sum('UM'),
            'total' => ArusLaluLintasBarat::where('Arah', 'utara')->count()
        ];

        // Traffic coming into West direction from all other directions
        $masukBarat = [
            'arus' => 'Masuk ke Barat',
            'MC' => ArusLaluLintasSelatan::where('Arah', 'barat')->sum('MC') +
                ArusLaluLintasTimur::where('Arah', 'barat')->sum('MC') +
                ArusLaluLintasUtara::where('Arah', 'barat')->sum('MC'),
            'LV' => ArusLaluLintasSelatan::where('Arah', 'barat')->sum('LV') +
                ArusLaluLintasTimur::where('Arah', 'barat')->sum('LV') +
                ArusLaluLintasUtara::where('Arah', 'barat')->sum('LV'),
            'HV' => ArusLaluLintasSelatan::where('Arah', 'barat')->sum('HV') +
                ArusLaluLintasTimur::where('Arah', 'barat')->sum('HV') +
                ArusLaluLintasUtara::where('Arah', 'barat')->sum('HV'),
            'UM' => ArusLaluLintasSelatan::where('Arah', 'barat')->sum('UM') +
                ArusLaluLintasTimur::where('Arah', 'barat')->sum('UM') +
                ArusLaluLintasUtara::where('Arah', 'barat')->sum('UM'),
            'total' => ArusLaluLintasSelatan::where('Arah', 'barat')->count() +
                ArusLaluLintasTimur::where('Arah', 'barat')->count() +
                ArusLaluLintasUtara::where('Arah', 'barat')->count()
        ];

        return [
            'belok_kiri' => $belokKiri,
            'jalan_lurus' => $jalanLurus,
            'belok_kanan' => $belokKanan,
            'masuk_barat' => $masukBarat
        ];
    }

    public function getTimurTrafficFlow()
    {
        // Left turn from East to North
        $belokKiri = [
            'arus' => 'Belok Kiri / Selatan',
            'MC' => ArusLaluLintasTimur::where('Arah', 'utara')->sum('MC'),
            'LV' => ArusLaluLintasTimur::where('Arah', 'utara')->sum('LV'),
            'HV' => ArusLaluLintasTimur::where('Arah', 'utara')->sum('HV'),
            'UM' => ArusLaluLintasTimur::where('Arah', 'utara')->sum('UM'),
            'total' => ArusLaluLintasTimur::where('Arah', 'utara')->count()
        ];

        // Straight from East to West
        $jalanLurus = [
            'arus' => 'Jalan Lurus / Barat',
            'MC' => ArusLaluLintasTimur::where('Arah', 'barat')->sum('MC'),
            'LV' => ArusLaluLintasTimur::where('Arah', 'barat')->sum('LV'),
            'HV' => ArusLaluLintasTimur::where('Arah', 'barat')->sum('HV'),
            'UM' => ArusLaluLintasTimur::where('Arah', 'barat')->sum('UM'),
            'total' => ArusLaluLintasTimur::where('Arah', 'barat')->count()
        ];

        // Right turn from East to South
        $belokKanan = [
            'arus' => 'Belok Kanan / Utara',
            'MC' => ArusLaluLintasTimur::where('Arah', 'selatan')->sum('MC'),
            'LV' => ArusLaluLintasTimur::where('Arah', 'selatan')->sum('LV'),
            'HV' => ArusLaluLintasTimur::where('Arah', 'selatan')->sum('HV'),
            'UM' => ArusLaluLintasTimur::where('Arah', 'selatan')->sum('UM'),
            'total' => ArusLaluLintasTimur::where('Arah', 'selatan')->count()
        ];

        // Traffic coming into East from all other directions
        $masukTimur = [
            'arus' => 'Masuk ke Timur',
            'MC' => ArusLaluLintasBarat::where('Arah', 'timur')->sum('MC') +
                ArusLaluLintasSelatan::where('Arah', 'timur')->sum('MC') +
                ArusLaluLintasUtara::where('Arah', 'timur')->sum('MC'),
            'LV' => ArusLaluLintasBarat::where('Arah', 'timur')->sum('LV') +
                ArusLaluLintasSelatan::where('Arah', 'timur')->sum('LV') +
                ArusLaluLintasUtara::where('Arah', 'timur')->sum('LV'),
            'HV' => ArusLaluLintasBarat::where('Arah', 'timur')->sum('HV') +
                ArusLaluLintasSelatan::where('Arah', 'timur')->sum('HV') +
                ArusLaluLintasUtara::where('Arah', 'timur')->sum('HV'),
            'UM' => ArusLaluLintasBarat::where('Arah', 'timur')->sum('UM') +
                ArusLaluLintasSelatan::where('Arah', 'timur')->sum('UM') +
                ArusLaluLintasUtara::where('Arah', 'timur')->sum('UM'),
            'total' => ArusLaluLintasBarat::where('Arah', 'timur')->count() +
                ArusLaluLintasSelatan::where('Arah', 'timur')->count() +
                ArusLaluLintasUtara::where('Arah', 'timur')->count()
        ];

        return [
            'belok_kiri' => $belokKiri,
            'jalan_lurus' => $jalanLurus,
            'belok_kanan' => $belokKanan,
            'masuk_timur' => $masukTimur
        ];
    }

    public function getSelatanTrafficFlow()
    {
        $belokKiri = [
            'arus' => 'Belok Kiri / Barat',
            'MC' => ArusLaluLintasSelatan::where('Arah', 'timur')->sum('MC'),
            'LV' => ArusLaluLintasSelatan::where('Arah', 'timur')->sum('LV'),
            'HV' => ArusLaluLintasSelatan::where('Arah', 'timur')->sum('HV'),
            'UM' => ArusLaluLintasSelatan::where('Arah', 'timur')->sum('UM'),
            'total' => ArusLaluLintasSelatan::where('Arah', 'timur')->count()
        ];

        $jalanLurus = [
            'arus' => 'Jalan Lurus / Utara',
            'MC' => ArusLaluLintasSelatan::where('Arah', 'utara')->sum('MC'),
            'LV' => ArusLaluLintasSelatan::where('Arah', 'utara')->sum('LV'),
            'HV' => ArusLaluLintasSelatan::where('Arah', 'utara')->sum('HV'),
            'UM' => ArusLaluLintasSelatan::where('Arah', 'utara')->sum('UM'),
            'total' => ArusLaluLintasSelatan::where('Arah', 'utara')->count()
        ];

        $belokKanan = [
            'arus' => 'Belok Kanan / Timur',
            'MC' => ArusLaluLintasSelatan::where('Arah', 'barat')->sum('MC'),
            'LV' => ArusLaluLintasSelatan::where('Arah', 'barat')->sum('LV'),
            'HV' => ArusLaluLintasSelatan::where('Arah', 'barat')->sum('HV'),
            'UM' => ArusLaluLintasSelatan::where('Arah', 'barat')->sum('UM'),
            'total' => ArusLaluLintasSelatan::where('Arah', 'barat')->count()
        ];

        $masukSelatan = [
            'arus' => 'Masuk ke Selatan',
            'MC' => ArusLaluLintasBarat::where('Arah', 'selatan')->sum('MC') +
                ArusLaluLintasTimur::where('Arah', 'selatan')->sum('MC') +
                ArusLaluLintasUtara::where('Arah', 'selatan')->sum('MC'),
            'LV' => ArusLaluLintasBarat::where('Arah', 'selatan')->sum('LV') +
                ArusLaluLintasTimur::where('Arah', 'selatan')->sum('LV') +
                ArusLaluLintasUtara::where('Arah', 'selatan')->sum('LV'),
            'HV' => ArusLaluLintasBarat::where('Arah', 'selatan')->sum('HV') +
                ArusLaluLintasTimur::where('Arah', 'selatan')->sum('HV') +
                ArusLaluLintasUtara::where('Arah', 'selatan')->sum('HV'),
            'UM' => ArusLaluLintasBarat::where('Arah', 'selatan')->sum('UM') +
                ArusLaluLintasTimur::where('Arah', 'selatan')->sum('UM') +
                ArusLaluLintasUtara::where('Arah', 'selatan')->sum('UM'),
            'total' => ArusLaluLintasBarat::where('Arah', 'selatan')->count() +
                ArusLaluLintasTimur::where('Arah', 'selatan')->count() +
                ArusLaluLintasUtara::where('Arah', 'selatan')->count()
        ];

        return [
            'belok_kiri' => $belokKiri,
            'jalan_lurus' => $jalanLurus,
            'belok_kanan' => $belokKanan,
            'masuk_selatan' => $masukSelatan
        ];
    }

    public function getUtaraTrafficFlow()
    {
        $belokKiri = [
            'arus' => 'Belok Kiri / Timur',
            'MC' => ArusLaluLintasUtara::where('Arah', 'barat')->sum('MC'),
            'LV' => ArusLaluLintasUtara::where('Arah', 'barat')->sum('LV'),
            'HV' => ArusLaluLintasUtara::where('Arah', 'barat')->sum('HV'),
            'UM' => ArusLaluLintasUtara::where('Arah', 'barat')->sum('UM'),
            'total' => ArusLaluLintasUtara::where('Arah', 'barat')->count()
        ];

        $jalanLurus = [
            'arus' => 'Jalan Lurus / Selatan',
            'MC' => ArusLaluLintasUtara::where('Arah', 'selatan')->sum('MC'),
            'LV' => ArusLaluLintasUtara::where('Arah', 'selatan')->sum('LV'),
            'HV' => ArusLaluLintasUtara::where('Arah', 'selatan')->sum('HV'),
            'UM' => ArusLaluLintasUtara::where('Arah', 'selatan')->sum('UM'),
            'total' => ArusLaluLintasUtara::where('Arah', 'selatan')->count()
        ];

        $belokKanan = [
            'arus' => 'Belok Kanan / Barat',
            'MC' => ArusLaluLintasUtara::where('Arah', 'timur')->sum('MC'),
            'LV' => ArusLaluLintasUtara::where('Arah', 'timur')->sum('LV'),
            'HV' => ArusLaluLintasUtara::where('Arah', 'timur')->sum('HV'),
            'UM' => ArusLaluLintasUtara::where('Arah', 'timur')->sum('UM'),
            'total' => ArusLaluLintasUtara::where('Arah', 'timur')->count()
        ];

        $masukUtara = [
            'arus' => 'Masuk ke Utara',
            'MC' => ArusLaluLintasBarat::where('Arah', 'utara')->sum('MC') +
                ArusLaluLintasTimur::where('Arah', 'utara')->sum('MC') +
                ArusLaluLintasSelatan::where('Arah', 'utara')->sum('MC'),
            'LV' => ArusLaluLintasBarat::where('Arah', 'utara')->sum('LV') +
                ArusLaluLintasTimur::where('Arah', 'utara')->sum('LV') +
                ArusLaluLintasSelatan::where('Arah', 'utara')->sum('LV'),
            'HV' => ArusLaluLintasBarat::where('Arah', 'utara')->sum('HV') +
                ArusLaluLintasTimur::where('Arah', 'utara')->sum('HV') +
                ArusLaluLintasSelatan::where('Arah', 'utara')->sum('HV'),
            'UM' => ArusLaluLintasBarat::where('Arah', 'utara')->sum('UM') +
                ArusLaluLintasTimur::where('Arah', 'utara')->sum('UM') +
                ArusLaluLintasSelatan::where('Arah', 'utara')->sum('UM'),
            'total' => ArusLaluLintasBarat::where('Arah', 'utara')->count() +
                ArusLaluLintasTimur::where('Arah', 'utara')->count() +
                ArusLaluLintasSelatan::where('Arah', 'utara')->count()
        ];

        return [
            'belok_kiri' => $belokKiri,
            'jalan_lurus' => $jalanLurus,
            'belok_kanan' => $belokKanan,
            'masuk_utara' => $masukUtara
        ];
    }

    public function render()
    {
        $queryBarat = ArusLaluLintasBarat::query();
        $querySelatan = ArusLaluLintasSelatan::query();
        $queryTimur = ArusLaluLintasTimur::query();
        $queryUtara = ArusLaluLintasUtara::query();

        if ($this->search) {
            $queryBarat->where('ID_Simpang', 'like', '%' . $this->search . '%')
                ->orWhere('arah', 'like', '%' . $this->search . '%');
            $querySelatan->where('ID_Simpang', 'like', '%' . $this->search . '%')
                ->orWhere('arah', 'like', '%' . $this->search . '%');
            $queryTimur->where('ID_Simpang', 'like', '%' . $this->search . '%')
                ->orWhere('arah', 'like', '%' . $this->search . '%');
            $queryUtara->where('ID_Simpang', 'like', '%' . $this->search . '%')
                ->orWhere('arah', 'like', '%' . $this->search . '%');
        }

        return view('livewire.intersections', [
            'intersectionsBarat' => $queryBarat->paginate(10),
            'intersectionsSelatan' => $querySelatan->paginate(10),
            'intersectionsTimur' => $queryTimur->paginate(10),
            'intersectionsUtara' => $queryUtara->paginate(10),
            'totalCounts' => $this->getTotalCounts(),
            'combinedData' => $this->getCombinedData(),
            'inOutData' => $this->getInOutData(),
            'baratTrafficFlow' => $this->getBaratTrafficFlow(),
            'timurTrafficFlow' => $this->getTimurTrafficFlow(),
            'selatanTrafficFlow' => $this->getSelatanTrafficFlow(),
            'utaraTrafficFlow' => $this->getUtaraTrafficFlow(),
        ]);
    }

    public function getTotalCounts()
    {
        $totalMCBarat = ArusLaluLintasBarat::sum('MC');
        $totalLVBarat = ArusLaluLintasBarat::sum('LV');
        $totalHVBarat = ArusLaluLintasBarat::sum('HV');
        $totalUMBarat = ArusLaluLintasBarat::sum('UM');

        $totalMCSelatan = ArusLaluLintasSelatan::sum('MC');
        $totalLVSelatan = ArusLaluLintasSelatan::sum('LV');
        $totalHVSelatan = ArusLaluLintasSelatan::sum('HV');
        $totalUMSelatan = ArusLaluLintasSelatan::sum('UM');

        $totalMCTimur = ArusLaluLintasTimur::sum('MC');
        $totalLVTimur = ArusLaluLintasTimur::sum('LV');
        $totalHVTimur = ArusLaluLintasTimur::sum('HV');
        $totalUMTimur = ArusLaluLintasTimur::sum('UM');

        $totalMCUtara = ArusLaluLintasUtara::sum('MC');
        $totalLVUtara = ArusLaluLintasUtara::sum('LV');
        $totalHVUtara = ArusLaluLintasUtara::sum('HV');
        $totalUMUtara = ArusLaluLintasUtara::sum('UM');

        $totalMC = $totalMCBarat + $totalMCSelatan + $totalMCTimur + $totalMCUtara;
        $totalLV = $totalLVBarat + $totalLVSelatan + $totalLVTimur + $totalLVUtara;
        $totalHV = $totalHVBarat + $totalHVSelatan + $totalHVTimur + $totalHVUtara;
        $totalUM = $totalUMBarat + $totalUMSelatan + $totalUMTimur + $totalUMUtara;

        return [
            'totalMCBarat' => $totalMCBarat,
            'totalLVBarat' => $totalLVBarat,
            'totalHVBarat' => $totalHVBarat,
            'totalUMBarat' => $totalUMBarat,
            'totalMCSelatan' => $totalMCSelatan,
            'totalLVSelatan' => $totalLVSelatan,
            'totalHVSelatan' => $totalHVSelatan,
            'totalUMSelatan' => $totalUMSelatan,
            'totalMCTimur' => $totalMCTimur,
            'totalLVTimur' => $totalLVTimur,
            'totalHVTimur' => $totalHVTimur,
            'totalUMTimur' => $totalUMTimur,
            'totalMCUtara' => $totalMCUtara,
            'totalLVUtara' => $totalLVUtara,
            'totalHVUtara' => $totalHVUtara,
            'totalUMUtara' => $totalUMUtara,
            'totalMC' => $totalMC,
            'totalLV' => $totalLV,
            'totalHV' => $totalHV,
            'totalUM' => $totalUM,
        ];
    }

    // public function resetFields()
    // {
    //     $this->reset([
    //         'simpang_id', 
    //         'Nama_Simpang', 
    //         'Kota', 
    //         'Ukuran_Kota', 
    //         'Tanggal', 
    //         'Periode', 
    //         'Ditangani_Oleh',
    //         'selectedIntersection'
    //     ]);
    //     $this->mode = 'create';
    // }

    //     public function create()
    //     {
    //         $this->validate();

    //         Simpang::create([
    //             'Nama_Simpang' => $this->Nama_Simpang,
    //             'Kota' => $this->Kota,
    //             'Ukuran_Kota' => $this->Ukuran_Kota,
    //             'Tanggal' => $this->Tanggal,
    //             'Periode' => $this->Periode,
    //             'Ditangani_Oleh' => $this->Ditangani_Oleh
    //         ]);

    //         $this->resetFields();
    //         session()->flash('message', 'Simpang berhasil ditambahkan.');
    //         $this->mode = 'list';
    //     }

    // public function edit($id)
    // {
    //     $simpang = Simpang::findOrFail($id);
    //     $this->simpang_id = $simpang->id;
    //     $this->Nama_Simpang = $simpang->Nama_Simpang;
    //     $this->Kota = $simpang->Kota;
    //     $this->Ukuran_Kota = $simpang->Ukuran_Kota;
    //     $this->Tanggal = $simpang->Tanggal;
    //     $this->Periode = $simpang->Periode;
    //     $this->Ditangani_Oleh = $simpang->Ditangani_Oleh;
    // }

    // public function update()
    // {
    //     $this->validate();

    //     $simpang = Simpang::findOrFail($this->simpang_id);
    //     $simpang->update([
    //         'Nama_Simpang' => $this->Nama_Simpang,
    //         'Kota' => $this->Kota,
    //         'Ukuran_Kota' => $this->Ukuran_Kota,
    //         'Tanggal' => $this->Tanggal,
    //         'Periode' => $this->Periode,
    //         'Ditangani_Oleh' => $this->Ditangani_Oleh
    //     ]);

    //     $this->dispatch('simpangUpdated');
    //     $this->resetFields();
    // }

    //     public function delete($id)
    //     {
    //         $simpang = Simpang::findOrFail($id);
    //         $simpang->delete();

    //         session()->flash('message', 'Simpang berhasil dihapus.');
    //     }

    //     public function selectIntersection($id)
    //     {
    //         if (!$id) {
    //             return;
    //         }

    //         try {
    //             $intersection = Intersection::query()
    //                 ->with(['geometries', 'trafficFlows'])
    //                 ->find($id);

    //             if ($intersection) {
    //                 $this->selectedIntersection = $intersection;
    //                 $this->mode = 'simulate';
    //             }
    //         } catch (\Exception $e) {
    //             session()->flash('error', 'Intersection not found.');
    //             $this->selectedIntersection = null;
    //         }
    //     }

    //     // Add a new method to handle the simulation logic
    //     public function simulate()
    //     {
    //         if ($this->selectedIntersection) {
    //             // Add your simulation logic here
    //             // For example, you can load related data or perform calculations
    //         }
    //     }

}
