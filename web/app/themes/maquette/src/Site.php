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

    public function registerMenus(): void
    {
        register_nav_menus([
            'header' => 'Menu principal'
        ]);
    }

    public function registerPostTypes(): void
    {
        $this->addType('case-study', [
            'menu_icon' => 'dashicons-welcome-learn-more',
            'supports' => ['excerpt','title','thumbnail'],
            'menu_position' => 6
        ], 'Etude de cas', 'Etude de cas', false);
    }

    public function registerTaxonomies(): void
    {
        $this->addTaxonomy('case-study-type', ['case-study'], "Type d'étude");
    }
}
