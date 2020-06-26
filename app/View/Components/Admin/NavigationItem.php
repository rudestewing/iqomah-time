<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class NavigationItem extends Component
{
    public $url;
    public $name;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url, $name)
    {
        $this->url = $url;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.admin.navigation-item');
    }
}
