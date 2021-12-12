<?php

    class Data
    {
        /** Private const */
        private const DATA_PATH = '/stations/refresh_data/';

        public function __construct()
        {

        }

        public function dataGetLastUpdated():string
        {
            $lastUpdated = json_decode(file_get_contents(self::DATA_PATH . 'log.json'), true);

            return (string)$lastUpdated;
        }

    }

?>