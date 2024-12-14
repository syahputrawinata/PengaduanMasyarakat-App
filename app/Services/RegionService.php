<?php

namespace App\Services;

use GuzzleHttp\Client;

class RegionService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://www.emsifa.com/api-wilayah-indonesia/api/'
        ]);
    }

    public function getProvinceName($provinceId)
    {
        $response = $this->client->get('provinces.json');
        $provinces = json_decode($response->getBody()->getContents(), true);

        $province = collect($provinces)->firstWhere('id', $provinceId);
        return $province ? $province['name'] : null;
    }

    public function getRegencyName($provinceId, $regencyId)
    {
        $response = $this->client->get("regencies/{$provinceId}.json");
        $regencies = json_decode($response->getBody()->getContents(), true);

        $regency = collect($regencies)->firstWhere('id', $regencyId);
        return $regency ? $regency['name'] : null;
    }

    public function getDistrictName($regencyId, $districtId)
    {
        $response = $this->client->get("districts/{$regencyId}.json");
        $districts = json_decode($response->getBody()->getContents(), true);

        $district = collect($districts)->firstWhere('id', $districtId);
        return $district ? $district['name'] : null;
    }

    public function getVillageName($districtId, $villageId)
    {
        $response = $this->client->get("villages/{$districtId}.json");
        $villages = json_decode($response->getBody()->getContents(), true);

        $village = collect($villages)->firstWhere('id', $villageId);
        return $village ? $village['name'] : null;
    }
}
