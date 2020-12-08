<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CompanyTransferorConveyanceForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.company-transferor-conveyance-form');
    }
}
