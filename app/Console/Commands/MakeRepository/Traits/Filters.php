<?php

namespace App\Console\Commands\MakeRepository\Traits;

trait Filters
{
    /**
     * Filter the content from the stub file.
     *
     * @param string $file
     *
     * @return string
     */
    public function filter($file)
    {
        return str_replace(
            ['DummyClass', 'DummyModel', 'DummyTable', 'DummySingular'],
            [$this->getClassName(), $this->getModelName(), $this->getTableName(), $this->getSingularLowerCaseName()],
            $file
        );
    }

    /**
     * Generate the Class name
     *
     * @return string
     */
    public function getClassName()
    {
        return studly_case($this->argument('repoName'));
    }

    /**
     * Generate the Model name
     *
     * @return string
     */
    public function getModelName()
    {
        return studly_case(str_singular($this->argument('repoName')));
    }

    /**
     * Generate the Table name
     *
     * @return string
     */
    public function getTableName()
    {
        return snake_case($this->argument('repoName'));
    }

    /**
     * Generate the singular repoName
     *
     * @return string
     */
    public function getSingularName()
    {
        return str_singular($this->argument('repoName'));
    }

    /**
     * Generate the singular and lowercase: reponame
     *
     * @return string
     */
    public function getSingularLowerCaseName()
    {
        return strtolower(str_singular($this->argument('repoName')));
    }

    /**
     * Generate the lowercase reponame
     *
     * @return string
     */
    public function getLowerCaseName()
    {
        return strtolower($this->argument('repoName'));
    }
}
