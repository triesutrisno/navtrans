<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Kecamatan;
use App\Models\Kota;
use App\Models\Lokasi;
use App\Models\Propinsi;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $propinsiJakarta = Propinsi::firstOrCreate(
            ['propinsi_kode' => '31'],
            ['propinsi_nama' => 'DKI Jakarta']
        );

        $propinsiJabar = Propinsi::firstOrCreate(
            ['propinsi_kode' => '32'],
            ['propinsi_nama' => 'Jawa Barat']
        );

        $kotaJaksel = Kota::firstOrCreate(
            ['propinsi_id' => $propinsiJakarta->id, 'kota_kode' => '3171'],
            ['kota_nama' => 'Kota Jakarta Selatan']
        );

        $kotaJakbar = Kota::firstOrCreate(
            ['propinsi_id' => $propinsiJakarta->id, 'kota_kode' => '3172'],
            ['kota_nama' => 'Kota Jakarta Barat']
        );

        $kotaBandung = Kota::firstOrCreate(
            ['propinsi_id' => $propinsiJabar->id, 'kota_kode' => '3273'],
            ['kota_nama' => 'Kota Bandung']
        );

        $kecamatanPasarMinggu = Kecamatan::firstOrCreate(
            ['kota_id' => $kotaJaksel->id, 'kecamatan_kode' => '3171080'],
            ['kecamatan_nama' => 'Pasar Minggu']
        );

        $kecamatanCengkareng = Kecamatan::firstOrCreate(
            ['kota_id' => $kotaJakbar->id, 'kecamatan_kode' => '3172090'],
            ['kecamatan_nama' => 'Cengkareng']
        );

        $kecamatanCoblong = Kecamatan::firstOrCreate(
            ['kota_id' => $kotaBandung->id, 'kecamatan_kode' => '3273030'],
            ['kecamatan_nama' => 'Coblong']
        );

        Lokasi::firstOrCreate(
            ['kecamatan_id' => $kecamatanPasarMinggu->id, 'lokasi_nama' => 'Gudang Selatan'],
            [
                'lokasi_alamat' => 'Jl. Raya Pasar Minggu No. 10, Jakarta Selatan',
                'lokasi_tipe' => 'Gudang',
                'lokasi_kontak' => '021-1234567',
            ]
        );

        Lokasi::firstOrCreate(
            ['kecamatan_id' => $kecamatanCengkareng->id, 'lokasi_nama' => 'Kantor Pusat Barat'],
            [
                'lokasi_alamat' => 'Jl. Kapuk Raya No. 20, Jakarta Barat',
                'lokasi_tipe' => 'Kantor',
                'lokasi_kontak' => '021-2345678',
            ]
        );

        Lokasi::firstOrCreate(
            ['kecamatan_id' => $kecamatanCoblong->id, 'lokasi_nama' => 'Depo Bandung'],
            [
                'lokasi_alamat' => 'Jl. Ir. H. Juanda No. 33, Bandung',
                'lokasi_tipe' => 'Depo',
                'lokasi_kontak' => '022-3456789',
            ]
        );

        Customer::firstOrCreate(
            ['customer_email' => 'customer1@example.com'],
            [
                'customer_nama' => 'PT. Makmur Jaya',
                'customer_npwp' => '01.234.567.8-901.000',
                'customer_alamat' => 'Jl. Sudirman No. 45, Jakarta Selatan',
                'customer_kontak' => '0812-3456-7890',
                'customer_status' => '1',
            ]
        );

        Customer::firstOrCreate(
            ['customer_email' => 'customer2@example.com'],
            [
                'customer_nama' => 'PT. Nusantara Logistik',
                'customer_npwp' => '02.345.678.9-012.000',
                'customer_alamat' => 'Jl. Merdeka No. 88, Bandung',
                'customer_kontak' => '0813-4567-8901',
                'customer_status' => '1',
            ]
        );

        Customer::firstOrCreate(
            ['customer_email' => 'customer3@example.com'],
            [
                'customer_nama' => 'PT. Ekspedisi Cepat',
                'customer_npwp' => '03.456.789.0-123.000',
                'customer_alamat' => 'Jl. Veteran No. 12, Jakarta Barat',
                'customer_kontak' => '0814-5678-9012',
                'customer_status' => '1',
            ]
        );
    }
}
