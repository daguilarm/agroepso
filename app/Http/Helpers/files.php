<?php

/**
 * Get files from folder
 *
 * @param obj $crop
 * @return string
 */
if (!function_exists('getFilesFromFolder')) {
    function getFilesFromFolder(string $folder, bool $emptyOption = true, array $file = []) : array
    {
        //Get the file
        $path = base_path('resources/views/dashboard/' . $folder);
        if (!file_exists($path)) {
            return [];
        }

        //Get the folder content
        $folder = scandir($path);

        //Get all the files
        foreach ($folder as $filename) {
            if($filename !== '.' && $filename !== '..') {
                $item = explode('.', $filename);
                if($item[0]) {
                    $file[$item[0]] = $item[0];
                }
            }
        }

        return $emptyOption
            ? ['' => ''] + $file
            : $file;
    }
}
