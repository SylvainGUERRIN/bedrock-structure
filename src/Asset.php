<?php

namespace App;

class Asset
{
    /**
     * @var array
     */
    private $manifest;

    /**
     * @var string
     */
    private $assetsPath;

    public function __construct(string $assetsPath)
    {
        $this->assetsPath = $assetsPath;
    }

    public function getPath(string $filename): ?string
    {
        $path = $this->getManifest()[$filename] ?? $filename;
        if (strpos($path, 'http://') !== false) {
            return $path;
        }
        return get_stylesheet_directory_uri() . '/assets/' . $path;
    }

    /**
     * @return array|mixed
     */
    public function getManifest()
    {
        if (!$this->manifest) {
            $this->manifest = json_decode(file_get_contents($this->assetsPath . '/manifest.json'), true);
        }
        return $this->manifest;
    }
}
