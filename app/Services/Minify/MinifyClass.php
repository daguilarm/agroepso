<?php

namespace App\Services\Minify;

use App\Services\Minify\MinifyJavascript;

class MinifyClass extends MinifyJavascript {

    private $buffer;
    private $file = 'javascript.js';

    /**
     * @param $files
     * @return mixed|string
     */
    public function debug()
    {
            return $this->buffer;
    }

    /**
     * @param $files
     * @return mixed|string
     */
    public function css()
    {
        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $this->buffer);
        $buffer = str_replace(["\r\n","\r","\n","\t",'  ','    ','     '], '', $buffer);
        $buffer = preg_replace(['(( )+{)','({( )+)'], '{', $buffer);
        $buffer = preg_replace(['(( )+})','(}( )+)','(;( )*})'], '}', $buffer);
        $buffer = preg_replace(['(;( )+)','(( )+;)'], ';', $buffer);

        return $buffer;
    }

    /**
     * @param $files
     * @return mixed|string
     */
    public function js() {
        return self::minify($this->buffer);
    }

    /**
     * Concatenate an array of files into a string
     *
     * @param $file
     * @return string
     */
    public function file($file)
    {
        $this->buffer = file_get_contents(resource_path('assets/' . $file));

        return $this;
    }
}
