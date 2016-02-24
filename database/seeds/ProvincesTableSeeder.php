<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement(
            "INSERT INTO `provinces` (`id`, `province_name`, `province_name_abbr`, `province_name_id`, `province_name_en`, `province_capital_city_id`, `iso_code`, `iso_name`, `iso_type`, `iso_geounit`, `country_iso`, `timezone`, `province_lat`, `province_lon`) VALUES
            (11, 'aceh', 'NAD', 'Nanggroe Aceh Darussalam', 'Nanggroe Aceh Darussalam', 1171, 'ID-AC', 'Aceh', 'autonomous province', 'SM', 'ID', 7, 4.695135, 96.749397),
            (12, 'sumatera utara', 'Sumut', 'Sumatera Utara', 'North Sumatera', 1275, 'ID-SU', 'Sumatera Utara', 'province', 'SM', 'ID', 7, 3.585242, 98.675598),
            (13, 'sumatera barat', 'Sumbar', 'Sumatera Barat', 'West Sumatera', 1371, 'ID-SB', 'Sumatera Barat', 'province', 'SM', 'ID', 7, -0.953730, 100.351990),
            (14, 'riau', 'Riau', 'Riau', 'Riau', 1471, 'ID-RI', 'Riau', 'province', 'SM', 'ID', 7, 0.293347, 101.706818),
            (15, 'jambi', 'Jambi', 'Jambi', 'Jambi', 1571, 'ID-JA', 'Jambi', 'province', 'SM', 'ID', 7, -1.485180, 102.438049),
            (16, 'sumatera selatan', 'Sumsel', 'Sumatera Selatan', 'South Sumatera', 1671, 'ID-SS', 'Sumatera Selatan', 'province', 'SM', 'ID', 7, -2.991100, 104.756729),
            (17, 'bengkulu', 'Bengkulu', 'Bengkulu', 'Bengkulu', 1771, 'ID-BE', 'Bengkulu', 'province', 'SM', 'ID', 7, -3.800640, 102.256203),
            (18, 'lampung', 'Lampung', 'Lampung', 'Lampung', 1871, 'ID-LA', 'Lampung', 'province', 'SM', 'ID', 7, -4.558580, 105.406799),
            (19, 'kepulauan bangka belitung', 'Babel', 'Kepulauan Bangka Belitung', 'Bangka Belitung Islands', 1971, 'ID-BB', 'Bangka Belitung', 'province', 'SM', 'ID', 7, -2.741050, 106.440582),
            (21, 'kepulauan riau', 'Kepri', 'Kepulauan Riau', 'Riau Islands', 2172, 'ID-KR', 'Kepulauan Riau', 'province', 'SM', 'ID', 7, 1.082828, 104.030449),
            (31, 'dki jakarta', 'DKI', 'DKI Jakarta', 'Special Capital Region of Jakarta', 3173, 'ID-JK', 'Jakarta Raya', 'special district', 'JW', 'ID', 7, -6.211540, 106.845169),
            (32, 'jawa barat', 'Jabar', 'Jawa Barat', 'West Java', 3273, 'ID-JB', 'Jawa Barat', 'province', 'JW', 'ID', 7, -6.914740, 107.609810),
            (33, 'jawa tengah', 'Jateng', 'Jawa Tengah', 'Central Java', 3374, 'ID-JT', 'Jawa Tengah', 'province', 'JW', 'ID', 7, -6.966660, 110.416656),
            (34, 'di yogyakarta', 'DIY', 'DI Yogyakarta', 'Yogyakarta Special Region', 3471, 'ID-YO', 'Yogyakarta', 'special region', 'JW', 'ID', 7, -7.797220, 110.368790),
            (35, 'jawa timur', 'Jatim', 'Jawa Timur', 'East Java', 3578, 'ID-JI', 'Jawa Timur', 'province', 'JW', 'ID', 7, -7.289160, 112.734390),
            (36, 'banten', 'Banten', 'Banten', 'Banten', 3673, 'ID-BT', 'Banten', 'province', 'JW', 'ID', 7, -6.120090, 106.150291),
            (51, 'bali', 'Bali', 'Bali', 'Bali', 5171, 'ID-BA', 'Bali', 'province', 'NU', 'ID', 8, -8.656290, 115.222092),
            (52, 'nusa tenggara barat', 'NTB', 'Nusa Tenggara Barat', 'West Nusa Tenggara', 5271, 'ID-NB', 'Nusa Tenggara Barat', 'province', 'NU', 'ID', 8, -8.583330, 116.116661),
            (53, 'nusa tenggara timur', 'NTT', 'Nusa Tenggara Timur', 'East Nusa Tenggara', 5371, 'ID-NT', 'Nusa Tenggara Timur', 'province', 'NU', 'ID', 8, -10.172400, 123.577904),
            (61, 'kalimantan barat', 'Kalbar', 'Kalimantan Barat', 'West Kalimantan', 6171, 'ID-KB', 'Kalimantan Barat', 'province', 'KA', 'ID', 7, -0.022520, 109.330299),
            (62, 'kalimantan tengah', 'Kalteng', 'Kalimantan Tengah', 'Central Kalimantan', 6271, 'ID-KT', 'Kalimantan Tengah', 'province', 'KA', 'ID', 7, -2.226660, 113.944160),
            (63, 'kalimantan selatan', 'Kalsel', 'Kalimantan Selatan', 'South Kalimantan', 6371, 'ID-KS', 'Kalimantan Selatan', 'province', 'KA', 'ID', 8, -3.328490, 114.589203),
            (64, 'kalimantan timur', 'Kaltim', 'Kalimantan Timur', 'East Kalimantan', 6472, 'ID-KI', 'Kalimantan Timur', 'province', 'KA', 'ID', 8, -1.265380, 116.831200),
            (65, 'kalimantan utara', 'Kaltara', 'Kalimantan Utara', 'North Kalimantan', 6571, 'ID-KU', 'Kalimantan Utara', 'province', 'KA', 'ID', 8, 2.850000, 117.383331),
            (71, 'sulawesi utara', 'Sulut', 'Sulawesi Utara', 'Nourth Sulawesi', 7171, 'ID-SA', 'Sulawesi Utara', 'province', 'SL', 'ID', 8, 1.493056, 124.841263),
            (72, 'sulawesi tengah', 'Sulteng', 'Sulawesi Tengah', 'Central Sulawesi', 7271, 'ID-ST', 'Sulawesi Tengah', 'province', 'SL', 'ID', 8, -0.898580, 119.850601),
            (73, 'sulawesi selatan', 'Sulsel', 'Sulawesi Selatan', 'South Sulawesi', 7371, 'ID-SN', 'Sulawesi Selatan', 'province', 'SL', 'ID', 8, -5.133330, 119.416656),
            (74, 'sulawesi tenggara', 'Sultra', 'Sulawesi Tenggara', 'South East Sulawesi', 7471, 'ID-SG', 'Sulawesi Tenggara', 'province', 'SL', 'ID', 8, -3.967480, 122.594704),
            (75, 'gorontalo', 'Gorontalo', 'Gorontalo', 'Gorontalo', 7571, 'ID-GO', 'Gorontalo', 'province', 'SL', 'ID', 8, 0.552512, 123.065491),
            (76, 'sulawesi barat', 'Sulbar', 'Sulawesi Barat', 'West Sulawesi', 7604, 'ID-SR', 'Sulawesi Barat', 'province', 'SL', 'ID', 8, -2.699190, 118.862106),
            (81, 'maluku', 'Maluku', 'Maluku', 'Maluku', 8171, 'ID-MA', 'Maluku', 'province', 'ML', 'ID', 9, -3.656070, 128.166412),
            (82, 'maluku utara', 'Malut', 'Maluku Utara', 'North Maluku', 8271, 'ID-MU', 'Maluku Utara', 'province', 'ML', 'ID', 9, 0.788068, 127.377151),
            (91, 'papua barat', 'Papua Barat', 'Papua Barat', 'West Papua', 9105, 'ID-PB', 'Papua Barat', 'province', 'IJ', 'ID', 9, -0.861520, 134.078796),
            (94, 'papua', 'Papua', 'Papua', 'Papua', 9471, 'ID-PA', 'Papua', 'province', 'IJ', 'ID', 9, -2.541360, 140.706390)"
        );
    }
}
