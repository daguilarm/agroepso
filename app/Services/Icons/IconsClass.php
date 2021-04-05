<?php 

namespace App\Services\Icons;

use App\Services\Icons\IconsInterface;

class IconsClass
{
    /**
     * @var private
     */
    private $builder;

    /**
     * Initialize the constructor
     */
    public function __construct()
    {
        $this->builder = app(IconsInterface::class);
    }

    /**
     * Get the icon
     * 
     * @param $name [The icon name]
     * @param $class [Add extra classes]
     * 
     * @return mixed
     */
    public function get(string $name, $class = '')
    {
        //Get the file with all the icons, and get the selected one
        $icon = $this->getFile($this->builder->folder)[$name] ?? null;

        return $icon
            ? $this->builder->htmlBuilder($icon, $class)
            : null;
    }

    /**
     * Get the CDN
     * @return string
     */
    public function cdn() : string
    {
        return sprintf('<link rel="stylesheet" type="text/css" href="%s">', $this->builder->repository);
    }

    /**
     * Get the file content
     * @return array
     */
    private function getFile($folder) : array
    {
        return include(app_path('Services/Icons/Fonts/' . $folder . '/Data.php'));
    }
}
