<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'icon' => 'wrench',
                'name' => 'Servis Motor',
                'description' => 'Kami menawarkan layanan servis motor berkualitas tinggi yang dilakukan oleh mekanik berpengalaman.'
            ],
            [
                'icon' => 'cogs',
                'name' => 'Penggantian Suku Cadang',
                'description' => 'Suku cadang berkualitas untuk motor Anda, tersedia dalam berbagai jenis dan merek.'
            ],
            [
                'icon' => 'motorcycle',
                'name' => 'Custom Motor',
                'description' => 'Layanan kustomisasi motor sesuai keinginan Anda, dari modifikasi ringan hingga besar.'
            ],
            [
                'icon' => 'oil-can',
                'name' => 'Penggantian Oli',
                'description' => 'Layanan penggantian oli berkualitas untuk menjaga performa mesin motor Anda tetap optimal.'
            ],
            [
                'icon' => 'battery',
                'name' => 'Pengecekan dan Penggantian Aki',
                'description' => 'Layanan pengecekan dan penggantian aki untuk memastikan sistem kelistrikan motor Anda berfungsi dengan baik.'
            ],
            [
                'icon' => 'tyre',
                'name' => 'Penggantian dan Perawatan Ban',
                'description' => 'Layanan penggantian dan perawatan ban untuk keamanan dan kenyamanan berkendara Anda.'
            ],
            [
                'icon' => 'chain',
                'name' => 'Perawatan Rantai',
                'description' => 'Layanan perawatan dan penggantian rantai motor untuk performa dan umur pakai yang lebih lama.'
            ],
            [
                'icon' => 'paint-brush',
                'name' => 'Pengecatan Motor',
                'description' => 'Layanan pengecatan motor dengan berbagai pilihan warna dan desain untuk tampilan yang lebih segar dan menarik.'
            ],
            [
                'icon' => 'car-wash',
                'name' => 'Cuci Motor',
                'description' => 'Layanan cuci motor lengkap untuk menjaga kebersihan dan keindahan motor Anda.'
            ],
        ]);
    }
}
