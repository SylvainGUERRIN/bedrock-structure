<?php

namespace Maquette;

class Site extends \App\Site
{
    /**
     * Site constructor.
     * @param null $site_name_or_id
     */
    public function __construct($site_name_or_id = null)
    {
        parent::__construct($site_name_or_id);
        add_action('init', [$this, 'registerMenus']);
    }

    public function registerMenus()
    {
        register_nav_menus([
            'header' => 'Menu principal'
        ]);
    }
}
