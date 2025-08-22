<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Csvreader {

    function parse_file($file_path) {
        $csvData = [];
        $file = fopen($file_path, 'r');

        while (($row = fgetcsv($file)) !== FALSE) {
            $csvData[] = $row;
        }

        fclose($file);

        return $csvData;
    }
}
?>
