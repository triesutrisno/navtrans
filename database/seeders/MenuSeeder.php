<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $masterMenu = Menu::where('menu_nama', 'Master')
            ->where('menu_type', '1')
            ->first();

        if (! $masterMenu) {
            return;
        }

        $menuItems = [
            [
                'menu_nama' => 'Propinsi',
                'menu_link' => 'propinsi',
                'menu_keterangan' => 'Master propinsi',
                'menu_sort' => 6,
            ],
            [
                'menu_nama' => 'Kota',
                'menu_link' => 'kota',
                'menu_keterangan' => 'Master kota',
                'menu_sort' => 7,
            ],
            [
                'menu_nama' => 'Kecamatan',
                'menu_link' => 'kecamatan',
                'menu_keterangan' => 'Master kecamatan',
                'menu_sort' => 8,
            ],
        ];

        foreach ($menuItems as $item) {
            $menu = Menu::updateOrCreate(
                [
                    'menu_nama' => $item['menu_nama'],
                    'menu_parent' => $masterMenu->menu_id,
                ],
                [
                    'menu_link' => $item['menu_link'],
                    'menu_keterangan' => $item['menu_keterangan'],
                    'menu_parent' => $masterMenu->menu_id,
                    'menu_sort' => $item['menu_sort'],
                    'menu_status' => '1',
                    'menu_type' => '2',
                ]
            );

            foreach (['RoleMaster', 'RoleAdmin'] as $roleName) {
                DB::table('menurole')->updateOrInsert(
                    [
                        'menu_id' => $menu->menu_id,
                        'role_nama' => $roleName,
                    ],
                    [
                        'mrr' => '1',
                        'mrc' => '1',
                        'mru' => '1',
                        'mrd' => '1',
                        'menurole_status' => '1',
                    ]
                );
            }
        }
    }
}
