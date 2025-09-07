<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormDeleteConfirmation extends Component
{
    public $target;
    public $cdn = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
    public $title;
    public $text;
    public $confirmButton;
    public $cancelButton;

    /**
     * Create a new component instance.
     */
    public function __construct($target)
    {
        $this->target = $target;
        $this->title = __('messages.delete_confirmation.title');
        $this->text = __('messages.delete_confirmation.text');
        $this->confirmButton = __('messages.delete_confirmation.confirm_button');
        $this->cancelButton = __('messages.delete_confirmation.cancel_button');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-delete-confirmation');
    }
}
