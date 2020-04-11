<?php
namespace App;

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
}
