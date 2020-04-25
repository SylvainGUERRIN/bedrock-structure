<?php

namespace Maquette;

use Twig\Environment;
use Twig\TwigFunction;

class Site extends \App\Site
{
    /**
     * Site constructor.
     * @param null $site_name_or_id
     */
    public function __construct($site_name_or_id = null)
    {
        parent::__construct($site_name_or_id);
//        add_action('init', [$this, 'registerMenus']);
        add_filter('timber/twig', [$this, 'extendTwig']);
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
        $this->addType('illustration', [
            'menu_icon' => 'dashicons-admin-customizer',
            'supports' => ['excerpt','title','editor','thumbnail'],
            'menu_position' => 7
        ], 'Illustration', 'Illustrations', false);
    }

    public function registerTaxonomies(): void
    {
        $this->addTaxonomy('case-study-type', ['case-study'], "Type d'étude");
    }

    public function extendTwig(Environment $twig): Environment
    {
        $twig->addFunction(new TwigFunction('repository', function ($repository, $method, ...$args) {
            $repository = ucfirst($repository);
            $repository = "Maquette\\Repository\\{$repository}Repository";
            return call_user_func_array("$repository::$method", $args);
        }));
        return $twig;
    }
}
