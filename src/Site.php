<?php
namespace App;

use Twig\Environment;
use Twig\TwigFunction;

/**
 * Class Site
 */
class Site extends \Timber\Site
{

    /**
     * Site constructor.
     * @param null $site_name_or_id
     */
    public function __construct($site_name_or_id = null)
    {
        add_action('wp_enqueue_scripts', [$this, 'registerAssets']);
        add_action('init', [$this, 'registerMenus']);
        add_action('init', [$this, 'registerPostTypes']);
        add_action('init', [$this, 'registerTaxonomies']);
        add_filter('timber/twig', [$this, 'extendTwig']);
//        add_action('init', [$this, 'registerImages']);
        add_theme_support('html5');
        add_theme_support('title-tags');
        add_theme_support('post-thumbnails');
        add_theme_support('responsive-embeds');
        parent::__construct($site_name_or_id);
    }

    public function registerAssets(): void
    {
        $asset = new Asset(get_stylesheet_directory() . '/assets');
        wp_register_style('main', $asset->getPath('main.css'), [], '1.0.0');
        wp_register_script('main', $asset->getPath('main.js'), [], '1.0.0', true);
        wp_enqueue_script('main');
        wp_enqueue_style('main');
    }

    public function extendTwig(Environment $twig): Environment
    {
        $twig->addFunction(new TwigFunction('dump', static function (...$args) {
            dump($args);
            return '';
        }));
        return $twig;
    }

    public function registerMenus(): void
    {
    }

    public function registerPostTypes(): void
    {
    }

    public function registerTaxonomies(): void
    {
    }

    protected function addType(string $slug, array $options, string $singular, string $plural = null, bool $m = true): void
    {
        if ($plural === null) {
            $plural = $singular . 's';
        }
        $p = strtolower($plural);
        $s = strtolower($singular);
        $tous = $m ? 'Tous' : 'Toutes';
        $le = $m ? 'le' : 'la';
        $ce = $m ? 'ce' : 'cette';
        $un = $m ? 'un' : 'une';
        $nouveau = $m ? 'Nouveau' : 'Nouvelle';
        $n = strtolower($nouveau);

        $labels = [
            'name' => $singular,
            'singular_name' => $singular,
            'menu_name' => $plural,
            'name_admin_bar' => $singular,
            'add_new' => 'Ajouter',
            'add_new_item' => "Ajouter $un $n $s",
            'new_item' => "$nouveau $s",
            'edit_item' => "Editer $le $s",
            'view_item' => 'Voir',
            'all_items' => "$tous les $p",
            'search_items' => "Rechercher des $p",
            'not_found' => 'Aucun résultat',
            'not_found_in_trash' => 'Aucun éléments dans la corbeille'
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => ['slug' => $slug],
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'capability_type' => 'post',
            'map_meta_cap' => true,
            'supports' => ['title', 'editor','thumbnail']
        ];

        register_post_type($slug, array_merge($args, $options));
    }

    protected function addTaxonomy(string $slug, array $options, string $singular, string $plural = null, bool $m = true): void
    {
        if ($plural === null) {
            $plural = $singular . 's';
        }
        $p = strtolower($plural);
        $s = strtolower($singular);
        $tous = $m ? 'Tous' : 'Toutes';
        $le = $m ? 'le' : 'la';
        $ce = $m ? 'ce' : 'cette';
        $un = $m ? 'un' : 'une';
        $nouveau = $m ? 'Nouveau' : 'Nouvelle';
        $n = strtolower($nouveau);

        $labels = [
            'name' => $singular,
            'singular_name' => $singular,
            'menu_name' => $plural,
            'name_admin_bar' => $singular,
            'add_new' => 'Ajouter',
            'add_new_item' => "Ajouter $un $n $s",
            'new_item' => "$nouveau $s",
            'edit_item' => "Editer $le $s",
            'view_item' => 'Voir',
            'all_items' => "$tous les $p",
            'search_items' => "Rechercher des $p",
            'not_found' => 'Aucun résultat',
            'not_found_in_trash' => 'Aucun éléments dans la corbeille'
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => ['slug' => $slug],
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'capability_type' => 'post',
            'map_meta_cap' => true,
            'supports' => ['title', 'editor']
        ];

        register_taxonomy($slug, $options, array_merge($args, $options));
    }

//    private function registerImages(): void
//    {
//    }
}
