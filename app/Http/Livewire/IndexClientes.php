<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class IndexClientes extends Component
{
    //public $clientes;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $sort = 'nombre';
    public $direction = 'asc';

    public function render()
    {
        $clientes = Cliente::where('nombre', 'ilike', '%'.$this->search.'%')
            ->orwhere('apellido', 'ilike', '%' . $this->search . '%')
            ->orwhere('ci', 'ilike', $this->search . '%')
            ->orderby($this->sort, $this->direction)
            ->paginate(15);
        return view('livewire.index-clientes', compact('clientes'));
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
