<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PortafolioPracticoCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $portafolio_practico;
    public function __construct($portafolioPractico)
    {
        $this->portafolio_practico = $portafolioPractico;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.portafolio-practico-card');
    }
}
