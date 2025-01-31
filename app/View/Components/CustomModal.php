<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CustomModal extends Component
{
    public $id;
    public $maxWidth;

    public function __construct($id = null, $maxWidth = null)
    {
        $this->id = $id;
        $this->maxWidth = $maxWidth;
    }

    public function render()
    {
        return view('components.custom-modal');
    }
}