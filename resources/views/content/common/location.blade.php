<?php
if (!isset($GLOBALS['locations'])) {
    $GLOBALS['locations'] = [
        [
            'id' => 1,
            'name' => 'Aceh',
            'latitude' => '4.36855000',
            'longitude' => '97.02530000',
        ],
        [
            'id' => 2,
            'name' => 'Bali',
            'latitude' => '-8.23566000',
            'longitude' => '115.12239000',
        ],
        [
            'id' => 3,
            'name' => 'Banten',
            'latitude' => '-6.44538000',
            'longitude' => '106.13756000',
        ],
        [
            'id' => 4,
            'name' => 'Bengkulu',
            'latitude' => '-3.51868000',
            'longitude' => '102.53598000',
        ],
        [
            'id' => 5,
            'name' => 'DI Yogyakarta',
            'latitude' => '-7.79560000',
            'longitude' => '110.36950000',
        ],
        [
            'id' => 6,
            'name' => 'DKI Jakarta',
            'latitude' => '-6.17450000',
            'longitude' => '106.82270000',
        ],
        [
            'id' => 7,
            'name' => 'Gorontalo',
            'latitude' => '0.71862000',
            'longitude' => '122.45559000',
        ],
        [
            'id' => 8,
            'name' => 'Jambi',
            'latitude' => '-1.61157000',
            'longitude' => '102.77970000',
        ],
        [
            'id' => 9,
            'name' => 'Jawa Barat',
            'latitude' => '-6.88917000',
            'longitude' => '107.64047000',
        ],
        [
            'id' => 10,
            'name' => 'Jawa Tengah',
            'latitude' => '-7.30324000',
            'longitude' => '110.00441000',
        ],
        [
            'id' => 11,
            'name' => 'Jawa Timur',
            'latitude' => '-7.27597300',
            'longitude' => '112.80830400',
        ],
        [
            'id' => 12,
            'name' => 'Kalimantan Barat',
            'latitude' => '-0.13224000',
            'longitude' => '111.09689000',
        ],
        [
            'id' => 13,
            'name' => 'Kalimantan Selatan',
            'latitude' => '-2.94348000',
            'longitude' => '115.37565000',
        ],
        [
            'id' => 14,
            'name' => 'Kalimantan Tengah',
            'latitude' => '-1.49958000',
            'longitude' => '113.29033000',
        ],
        [
            'id' => 15,
            'name' => 'Kalimantan Timur',
            'latitude' => '0.78844000',
            'longitude' => '116.24200000',
        ],
        [
            'id' => 16,
            'name' => 'Kalimantan Utara',
            'latitude' => '2.72594000',
            'longitude' => '116.91100000',
        ],
        [
            'id' => 17,
            'name' => 'Kepulauan Bangka Belitung',
            'latitude' => '-2.75775000',
            'longitude' => '107.58394000',
        ],
        [
            'id' => 18,
            'name' => 'Kepulauan Riau',
            'latitude' => '-0.15478000',
            'longitude' => '104.58037000',
        ],
        [
            'id' => 19,
            'name' => 'Lampung',
            'latitude' => '-4.85550000',
            'longitude' => '105.02730000',
        ],
        [
            'id' => 20,
            'name' => 'Maluku',
            'latitude' => '-3.11884000',
            'longitude' => '129.42078000',
        ],
        [
            'id' => 21,
            'name' => 'Maluku Utara',
            'latitude' => '0.63012000',
            'longitude' => '127.97202000',
        ],
        [
            'id' => 22,
            'name' => 'Nusa Tenggara Barat',
            'latitude' => '-8.12179000',
            'longitude' => '117.63696000',
        ],
        [
            'id' => 23,
            'name' => 'Papua',
            'latitude' => '-3.98857000',
            'longitude' => '138.34853000',
        ],
        [
            'id' => 24,
            'name' => 'Papua Barat',
            'latitude' => '-1.38424000',
            'longitude' => '132.90253000',
        ],
        [
            'id' => 25,
            'name' => 'Riau',
            'latitude' => '0.50041000',
            'longitude' => '101.54758000',
        ],
        [
            'id' => 26,
            'name' => 'Sulawesi Barat',
            'latitude' => '-2.49745000',
            'longitude' => '119.39190000',
        ],
        [
            'id' => 27,
            'name' => 'Sulawesi Selatan',
            'latitude' => '-3.64467000',
            'longitude' => '119.94719000',
        ],
        [
            'id' => 28,
            'name' => 'Sulawesi Tengah',
            'latitude' => '-1.69378000',
            'longitude' => '120.80886000',
        ],
        [
            'id' => 29,
            'name' => 'Sulawesi Tenggara',
            'latitude' => '-3.54912000',
            'longitude' => '121.72796000',
        ],
        [
            'id' => 30,
            'name' => 'Sulawesi Utara',
            'latitude' => '0.65557000',
            'longitude' => '124.09015000',
        ],
        [
            'id' => 31,
            'name' => 'Sumatera Barat',
            'latitude' => '-1.14225000',
            'longitude' => '100.57610000',
        ],
        [
            'id' => 32,
            'name' => 'Sumatera Selatan',
            'latitude' => '-3.12668000',
            'longitude' => '104.09306000',
        ],
        [
            'id' => 33,
            'name' => 'Sumatera Utara',
            'latitude' => '2.19235000',
            'longitude' => '99.38122000',
        ],
        [
            'id' => 34,
            'name' => 'Nusa Tenggara Timur',
            'latitude' => '-8.56568000',
            'longitude' => '120.69786000',
        ],
    ];
}
?>

<script>
    const locations = {!! json_encode($GLOBALS['locations']) !!}
</script>
