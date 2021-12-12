<?php

    class Data
    {
        /** Private const */
        private const DATA_PATH = '/stations/refresh_data/';

        /** Private variable */
        private $_data;

        public function __construct()
        {
            $this->_data = json_decode(file_get_contents(self::DATA_PATH . 'data.json'), true);
        }

        public function dataGetLastUpdated(): array
        {
            $brutDate = $this->_data['pdv_liste']['pdv'][0]['prix'][0]['@maj'];

            $lastUpdated = explode('T', $brutDate);

            return (array)[
              0 => $lastUpdated[0],
              1 => $lastUpdated[1]
            ];
        }

        public function dataPricelessFuel(){
            foreach ($this->_data['pdv_liste']['pdv'] as $station){
                if (array_key_exists('prix', $station)){
                    foreach ($station['prix'] as $station_prix){
                        if(array_key_exists('@nom', (array)$station_prix)){
                            print $station_prix['@nom'];
                        }
                        if(array_key_exists('@valeur', (array)$station_prix)){
                            print $station_prix['@valeur'] . "€";
                        }
                    }
                }
            }
        }

    }

?>