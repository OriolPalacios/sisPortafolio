<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PortafolioTeoricoCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $portafolio_teorico;
    public function __construct($portafolioTeorico)
    {
        $this->portafolio_teorico = $portafolioTeorico;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.portafolio-teorico-card');
    }
}
