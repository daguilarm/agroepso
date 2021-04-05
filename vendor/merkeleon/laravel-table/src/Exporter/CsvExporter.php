<?php

namespace Merkeleon\Table\Exporter;

use Merkeleon\Table\Exporter;
use DB;


class CsvExporter extends Exporter
{

    public function export($model)
    {
        $modelColumns = DB::getSchemaBuilder()->getColumnListing($model->getModel()->getTable());
        $columns = array_intersect($this->columns, $modelColumns);

        $results = $model->get($columns)->toArray();

        return $this->toCSV($results);
    }

    protected function toCSV(array $fields, $delimiter = ';', $enclosure = '"', $encloseAll = false, $nullToMysqlNull = false)
    {
        $delimiter_esc = preg_quote($delimiter, '/');
        $enclosure_esc = preg_quote($enclosure, '/');

        $outputString = "";

        if ($fields) {
            $columnTitles = array_keys(array_first($fields));
            $outputString .= implode($delimiter, $columnTitles) . "\r\n";
        }

        foreach ($fields as $tempFields) {
            $output = [];
            foreach ($tempFields as $field) {
                if ($field === null && $nullToMysqlNull) {
                    $output[] = 'NULL';
                    continue;
                }
                // Enclose fields containing $delimiter, $enclosure or whitespace
                if ($encloseAll || preg_match("/(?:${delimiter_esc}|${enclosure_esc}|\s)/", $field)) {
                    $field = $enclosure . str_replace($enclosure, $enclosure . $enclosure, $field) . $enclosure;
                }
                $output[] = $field . " ";
            }
            $outputString .= implode($delimiter, $output) . "\r\n";
        }

        $file = storage_path('export-'.time().'.csv');
        file_put_contents($file, $outputString);

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            unlink($file);
            exit;
        }
    }

}