<?php

namespace App\Services\Info;

abstract class InfoBuilder {

    /**
     * @var protected
     */
    protected $columns;
    protected $legend;
    protected $prefix;
    protected $subfix;
    protected $table;

    /**
     * @var protected with default values
     */
    protected $class = 'table-striped table-bordered';
    protected $file = null;
    protected $template = 'default';

    /**
     * Database table
     *
     * @return mixed|string
     */
    public function table($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Set file to load array
     *
     * @return mixed|string
     */
    public function file($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Add prefix to columns
     *
     * @return mixed|string
     */
    public function prefix($prefix = null)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Add subfix to columns
     *
     * @return mixed|string
     */
    public function subfix($subfix = null)
    {
        $this->subfix = $subfix;

        return $this;
    }

    /**
     * Add template to table
     *
     * @return mixed|string
     */
    public function template($template = null)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Reset the css class
     *
     * @param string $class The css class name (will reset the default values)
     * @return mixed|string
     */
    public function class($class = null)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Add new classes to table
     *
     * @param string $legend The table title
     * @return mixed|string
     */
    public function legend($legend = null)
    {
        $this->legend = sprintf('<tr><th colspan="2"><h4>%s</h4></th></tr>', $legend);

        return $this;
    }

    /**
     * Add new classes to table
     *
     * @param string $class The css class to add
     * @return mixed|string
     */
    public function addClass($class = null)
    {
        $this->class .= ' ' . $class;

        return $this;
    }

    /**
     * Get template
     *
     * @return mixed|string
     */
    protected function getTemplate()
    {
        return app_path('Services/Info/Templates/' . $this->template);
    }

    /**
     * Get the columns from file
     *
     * @param string $table The table name
     * @return mixed|string
     */
    protected function getColumns($table = null)
    {
        $file = app_path('Info/' . self::getModel($table));

        return file_exists($file)
            ? include($file)
            : null;
    }

    /**
     * Get the model
     *
     * @param string $table The table name
     * @return mixed|string
     */
    protected function getModel($table = null)
    {
        if($this->file) {
            return $this->file . '.php';
        } else {
            $table = ($table ?? $this->table);
            return studly_case(strtolower(str_singular($table)))  . 'Info.php';
        }
    }
}
