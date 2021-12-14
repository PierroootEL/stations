<?php

    class Data
    {
        /** Private const */
        private const DATA_PATH = 'I:/stations/refresh_data/';

        /** Private variable */
        private $_data;
        private $_temp_gazole_less = array(
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

        private $_temp_gazole_much = array(
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

        private $_zip_code_stations = array();

        public function __construct()
        {
            $this->_data = json_decode(file_get_contents(self::DATA_PATH . 'data.json'), true);
        }

        public function dataGetLastUpdated(): string
        {
            $brutDate = json_decode(file_get_contents(self::DATA_PATH . 'log.json'), true);

            $lastUpdated = explode('_', $brutDate);

            return (string)"Le {$lastUpdated[0]} à {$lastUpdated[1]}";
        }

        public function dataPricelessFuel(): array
        {
            foreach ($this->_data['pdv_liste']['pdv'] as $station) {
                if (!array_key_exists('prix', $station)) {
                    continue;
                }
                foreach ($station['prix'] as $station_prix) {
                    if (!array_key_exists('@nom', (array)$station_prix)) {
                        continue;
                    }
                    if (!array_key_exists('@valeur', (array)$station_prix)) {
                        continue;
                    }
                    switch ($station_prix['@nom']) {
                        case 'Gazole':
                            if ($station_prix['@valeur'] < $this->_temp_gazole_less['prix']) {
                                $this->_temp_gazole_less['prix'] = $station_prix['@valeur'];
                                $this->_temp_gazole_less['cp'] = $station['@cp'];
                                $this->_temp_gazole_less['adresse'] = $station['adresse'];
                                $this->_temp_gazole_less['ville'] = $station['ville'];
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

            return [
                'gazole' => "{$this->_temp_gazole_less['prix']} centimes d'€ au {$this->_temp_gazole_less['adresse']}, {$this->_temp_gazole_less['ville']} ({$this->_temp_gazole_less['cp']})",
                'SP95' => "{$this->_temp_sp95_less['prix']} centimes d'€ au {$this->_temp_sp95_less['adresse']}, {$this->_temp_sp95_less['ville']} ({$this->_temp_sp95_less['cp']})",
                'SP98' => "{$this->_temp_sp98_less['prix']} centimes d'€ au {$this->_temp_sp98_less['adresse']}, {$this->_temp_sp98_less['ville']} ({$this->_temp_sp98_less['cp']})",
                'E85' => "{$this->_temp_e85_less['prix']} centimes d'€ au {$this->_temp_e85_less['adresse']}, {$this->_temp_e85_less['ville']} ({$this->_temp_e85_less['cp']})"
            ];
        }

        public function dataExpensiveFuel(): array
        {
            foreach ($this->_data['pdv_liste']['pdv'] as $station) {
                if (!array_key_exists('prix', $station)) {
                    continue;
                }
                foreach ($station['prix'] as $station_prix) {
                    if (!array_key_exists('@nom', (array)$station_prix)) {
                        continue;
                    }
                    if (!array_key_exists('@valeur', (array)$station_prix)) {
                        continue;
                    }
                    switch ($station_prix['@nom']) {
                        case 'Gazole':
                            if ($station_prix['@valeur'] > $this->_temp_gazole_much['prix']) {
                                $this->_temp_gazole_much['prix'] = $station_prix['@valeur'];
                                $this->_temp_gazole_much['cp'] = $station['@cp'];
                                $this->_temp_gazole_much['adresse'] = $station['adresse'];
                                $this->_temp_gazole_much['ville'] = $station['ville'];
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

            return [
                'gazole' => "{$this->_temp_gazole_much['prix']} centimes d'€ au {$this->_temp_gazole_much['adresse']}, {$this->_temp_gazole_much['ville']} ({$this->_temp_gazole_much['cp']})",
                'SP95' => "{$this->_temp_sp95_much['prix']} centimes d'€ au {$this->_temp_sp95_much['adresse']}, {$this->_temp_sp95_much['ville']} ({$this->_temp_sp95_much['cp']})",
                'SP98' => "{$this->_temp_sp98_much['prix']} centimes d'€ au {$this->_temp_sp98_much['adresse']}, {$this->_temp_sp98_much['ville']} ({$this->_temp_sp98_much['cp']})",
                'E85' => "{$this->_temp_e85_much['prix']} centimes d'€ au {$this->_temp_e85_much['adresse']}, {$this->_temp_e85_much['ville']} ({$this->_temp_e85_much['cp']})"
            ];
        }


        public function getStationsByZipCode(int $zip_code): array
        {
            $i = 0;
            foreach ($this->_data['pdv_liste']['pdv'] as $stations) {
                if ($stations['@cp'] != $zip_code) {
                    continue;
                }
                $this->_zip_code_stations[$i] = array(
                    'adresse' => $stations['adresse'],
                    'ville' => $stations['ville'],
                    'prix' => (array_key_exists('prix', $stations)) ? $stations['prix'] : null
                );
                $i++;
            }

        }

    }

?>