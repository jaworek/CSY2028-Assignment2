<?php

class CarController
{
    private $carsTable;
    private $manufacturersTable;

    public function __construct($carsTable, $manufacturersTable)
    {
        $this->carsTable = $carsTable;
        $this->manufacturersTable = $manufacturersTable;
    }

    public function showroom($manufacturerId)
    {
        if (empty($manufacturerId)) {
            $cars = $this->carsTable->findAll();
        } else {
            $cars = $this->carsTable->find('manufacturerId', $manufacturerId);
        }
        $manufacturers = $this->manufacturersTable->findAll();

        return [
            'template' => 'page/showroom.html.php',
            'title' => 'Our Cars',
            'variables' => [
                'cars' => $cars,
                'manufacturers' => $manufacturers
            ]
        ];
    }
}