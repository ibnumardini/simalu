<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormDeleteConfirmation extends Component
{
    public $target;
    public $cdn = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';

    /**
     * Create a new component instance.
     */
    public function __construct($target)
    {
        $this->target = $target;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-delete-confirmation');
    }
}
