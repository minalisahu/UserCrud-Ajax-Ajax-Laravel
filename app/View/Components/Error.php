<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;

class Error extends Component {

    public $errors = array();

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct() {
        if (Session::has('errors')) {
            $this->errors = Session::get('errors');
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render() {
        if (count($this->errors))
            return view('components.error');
    }

}
