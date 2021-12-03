<?php

class Price
{
    public $_pdv_liste;
    private $_buffer = 0;
    public function __construct(string $file)
    {
        $this->_pdv_liste = simplexml_load_file('price.xml');
    }

    public function getHighestPricePerFuel()
    {
        print_r($this->_pdv_liste);
        foreach($this->_pdv_liste->pdv as $stations){
            print_r($stations);
        }
    }

}

?>