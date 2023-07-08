<?php

namespace App\Http\Livewire;

use App\Models\Vehiculo;
use Livewire\Component;
use Livewire\WithPagination;

class IndexVehiculos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $sort = 'placa';
    public $direction = 'asc';


    public function render()
    {
        $vehiculos = Vehiculo::where('placa', 'ilike', '%' . $this->search . '%')
            ->orwhere('marca', 'ilike', '%' . $this->search . '%')
            ->orderby($this->sort, $this->direction)
            ->paginate(8);
        return view('livewire.index-vehiculos', compact('vehiculos'));
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'asc') {
                $this->direction = 'desc';
            } else {
                $this->direction = 'asc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }
}
