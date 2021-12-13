<?php

    class Data
    {
        /** Private const */
        private const DATA_PATH = 'C:/Users/Pierre/Documents/stations/refresh_data/';

        /** Private variable */
        private $_data;
        private $_temp_gazoile_less = array(
            'cp' => '',
            'adresse' => '',
            'ville' => '',
            'prix' => 9999
        );
        private $_temp_sp95_less = array(
            'cp' => '',
            'adresse' => '',
            'ville' => '',
            'prix' => 9999
        );
        private $_temp_sp98_less = array(
            'cp' => '',
            'adresse' => '',
            'ville' => '',
            'prix' => 9999
        );
        private $_temp_e85_less = array(
            'cp' => '',
            'adresse' => '',
            'ville' => '',
            'prix' => 9999
        );

        private $_temp_gazoile_much = array(
            'cp' => '',
            'adresse' => '',
            'ville' => '',
            'prix' => 0
        );
        private $_temp_sp95_much = array(
            'cp' => '',
            'adresse' => '',
            'ville' => '',
            'prix' => 0
        );
        private $_temp_sp98_much = array(
            'cp' => '',
            'adresse' => '',
            'ville' => '',
            'prix' => 0
        );
        private $_temp_e85_much = array(
            'cp' => '',
            'adresse' => '',
            'ville' => '',
            'prix' => 0
        );

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
                        if(!array_key_exists('@nom', (array)$station_prix)) {
                            continue;
                        }
                        if(!array_key_exists('@valeur', (array)$station_prix)) {
                            continue;
                        }
                        switch ($station_prix['@nom']) {
                            case 'Gazole':
                                if ($station_prix['@valeur'] < $this->_temp_gazoile_less['prix']) {
                                    $this->_temp_gazoile_less['prix'] = $station_prix['@valeur'];
                                    $this->_temp_gazoile_less['cp'] = $station['@cp'];
                                    $this->_temp_gazoile_less['adresse'] = $station['adresse'];
                                    $this->_temp_gazoile_less['ville'] = $station['ville'];
                                }
                                break;
                            case 'SP95':
                                if ($station_prix['@valeur'] < $this->_temp_sp95_less['prix']) {
                                    $this->_temp_sp95_less['prix'] = $station_prix['@valeur'];
                                    $this->_temp_sp95_less['cp'] = $station['@cp'];
                                    $this->_temp_sp95_less['adresse'] = $station['adresse'];
                                    $this->_temp_sp95_less['ville'] = $station['ville'];
                                }
                                break;
                            case 'SP98':
                                if ($station_prix['@valeur'] < $this->_temp_sp98_less['prix']) {
                                    $this->_temp_sp98_less['prix'] = $station_prix['@valeur'];
                                    $this->_temp_sp98_less['cp'] = $station['@cp'];
                                    $this->_temp_sp98_less['adresse'] = $station['adresse'];
                                    $this->_temp_sp98_less['ville'] = $station['ville'];
                                }
                                break;
                            case 'E85':
                                if ($station_prix['@valeur'] < $this->_temp_e85_less['prix']) {
                                    $this->_temp_e85_less['prix'] = $station_prix['@valeur'];
                                    $this->_temp_e85_less['cp'] = $station['@cp'];
                                    $this->_temp_e85_less['adresse'] = $station['adresse'];
                                    $this->_temp_e85_less['ville'] = $station['ville'];
                                }
                                break;
                        }
                    }
                }
            }

            return [
                $this->_temp_gazoile_less,
                $this->_temp_sp95_less,
                $this->_temp_sp98_less,
                $this->_temp_e85_less
            ];
        }

        public function dataExpensiveFuel(){
            foreach ($this->_data['pdv_liste']['pdv'] as $station){
                if (!array_key_exists('prix', $station)) {
                    continue;
                }
                foreach ($station['prix'] as $station_prix){
                    if(!array_key_exists('@nom', (array)$station_prix)) {
                        continue;
                    }
                    if(array_key_exists('@valeur', (array)$station_prix)){
                        switch ($station_prix['@nom']) {
                            case 'Gazole':
                                if ($station_prix['@valeur'] > $this->_temp_gazoile_much['prix']) {
                                    $this->_temp_gazoile_much['prix'] = $station_prix['@valeur'];
                                    $this->_temp_gazoile_much['cp'] = $station['@cp'];
                                    $this->_temp_gazoile_much['adresse'] = $station['adresse'];
                                    $this->_temp_gazoile_much['ville'] = $station['ville'];
                                }
                                break;
                            case 'SP95':
                                if ($station_prix['@valeur'] > $this->_temp_sp95_much['prix']) {
                                    $this->_temp_sp95_much['prix'] = $station_prix['@valeur'];
                                    $this->_temp_sp95_much['cp'] = $station['@cp'];
                                    $this->_temp_sp95_much['adresse'] = $station['adresse'];
                                    $this->_temp_sp95_much['ville'] = $station['ville'];
                                }
                                break;
                            case 'SP98':
                                if ($station_prix['@valeur'] > $this->_temp_sp98_much['prix']) {
                                    $this->_temp_sp98_much['prix'] = $station_prix['@valeur'];
                                    $this->_temp_sp98_much['cp'] = $station['@cp'];
                                    $this->_temp_sp98_much['adresse'] = $station['adresse'];
                                    $this->_temp_sp98_much['ville'] = $station['ville'];
                                }
                                break;
                            case 'E85':
                                if ($station_prix['@valeur'] > $this->_temp_e85_much['prix']) {
                                    $this->_temp_e85_much['prix'] = $station_prix['@valeur'];
                                    $this->_temp_e85_much['cp'] = $station['@cp'];
                                    $this->_temp_e85_much['adresse'] = $station['adresse'];
                                    $this->_temp_e85_much['ville'] = $station['ville'];
                                }
                                break;
                        }
                    }
                }
            }

            return [
                $this->_temp_gazoile_much,
                $this->_temp_sp95_much,
                $this->_temp_sp98_much,
                $this->_temp_e85_much
            ];
        }



    }

?>