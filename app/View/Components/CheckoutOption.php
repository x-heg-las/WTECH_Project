<?php

namespace App\View\Components;

use Session;
use Illuminate\View\Component;

class CheckoutOption extends Component
{
    
    public $name;
    public $label;
    public $text;
    public $domain;

    public function __construct($name, $text, $domain, $label)
    {
        $this->name = $name;
        $this->text = $text;
        $this->domain = $domain;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */

  
    
    public function isActive()
    {
        
        if(Session::has($this->name))
        {
            if(Session::get($this->name) === $this->text)
            {
                return 'active';
            }
        }
        return '';
    }

    public function render()
    {
        return view('components.checkout-option');
    }
}
