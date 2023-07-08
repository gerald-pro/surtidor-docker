<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AlertConfirmation extends Component
{

    /**
     * El titulo de la alerta.
     *
     * @var string
     */
    public $titulo;

    /**
     * El id que se le asignará al modal.
     *
     * @var string
     */
    public $id;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $titulo)
    {
        $this->titulo = $titulo;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert-confirmation');
    }
}
