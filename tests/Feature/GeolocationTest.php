<?php

namespace Tests\Feature;

use Tests\TestCase;
use Geolocation;

class GeolocationTest extends TestCase {

    public function test_gps_to_utm()
    {
        //Set the original WGS80 coordenates
        $gps = [38.6013212438086, -0.140444377152927];

        //Set the expected UTM coordenates
        $expected = [749020.60, 4276415.08, 'EPSG:32630'];

        //Verify the coordenate conversion
        $test = Geolocation::gpsToUtm($gps[0], $gps[1]);

        //Test the conversion
        $this->assertEquals($expected, $test);
    }

    public function test_sigpac_catastro()
    {
        //Set the original catastro reference
        $expected = '03107A00600104';

        //Verify the html5 parser
        $test = Geolocation::server('sigpac')->params('3,107,0,0,6,104')->get('catastro');

        //Test the conversion
        $this->assertEquals($expected, $test);
    }

    public function test_sigpac_area()
    {
        //Set the original total area
        $expected = '4.1890';

        //Verify the html5 parser
        $test = Geolocation::server('sigpac')->params('3,107,0,0,6,104')->get('area');

        //Test the conversion
        $this->assertEquals($expected, $test);
    }

    public function test_catastro_all()
    {
        //Set the catastro data
        $expected = ['03107A0', '0600104', '38.6013212438086', '-0.140444377152927', 'EPSG:4326'];

        //Verify the xml parser
        $test = Geolocation::server('catastro')->params('03107A00600104')->get();

        //Test the conversion
        $this->assertEquals($expected, $test);
    }

    public function test_height()
    {
        //Set the catastro data
        $expected = 50;

        //Verify the xml parser
        $test = Geolocation::server('geonames')->params(['37.874182', '-0.80210111'])->get();

        //Test the conversion
        $this->assertEquals($expected, $test);
    }
}
