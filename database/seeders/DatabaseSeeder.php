<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $data = array(
        //     array('id' => 1, 'name' => 'store', '_lft' => 1, '_rgt' => 20, 'parent_id' => null, 'taxonomy' => 'product_cat'),
        //     array('id' => 2, 'name' => 'notebooks', '_lft' => 2, '_rgt' => 7, 'parent_id' => 1, 'taxonomy' => 'product_cat'),
        //     array('id' => 3, 'name' => 'apple', '_lft' => 3, '_rgt' => 4, 'parent_id' => 2, 'taxonomy' => 'product_cat'),
        //     array('id' => 4, 'name' => 'lenovo', '_lft' => 5, '_rgt' => 6, 'parent_id' => 2, 'taxonomy' => 'product_cat'),
        //     array('id' => 5, 'name' => 'mobile', '_lft' => 8, '_rgt' => 19, 'parent_id' => 1, 'taxonomy' => 'product_cat'),
        //     array('id' => 6, 'name' => 'nokia', '_lft' => 9, '_rgt' => 10, 'parent_id' => 5, 'taxonomy' => 'product_cat'),
        //     array('id' => 7, 'name' => 'samsung', '_lft' => 11, '_rgt' => 14, 'parent_id' => 5, 'taxonomy' => 'product_cat'),
        //     array('id' => 8, 'name' => 'galaxy', '_lft' => 12, '_rgt' => 13, 'parent_id' => 7, 'taxonomy' => 'product_cat'),
        //     array('id' => 9, 'name' => 'sony', '_lft' => 15, '_rgt' => 16, 'parent_id' => 5, 'taxonomy' => 'product_cat'),
        //     array('id' => 10, 'name' => 'lenovo', '_lft' => 17, '_rgt' => 18, 'parent_id' => 5, 'taxonomy' => 'product_cat'),

        // );
        // DB::table('taxonomy')->insert($data);

        $data_supplier = [
            [
                'id' => 1,
                'name' => 'OBN LAND',
                'phone' => '0787774949',
                'address' => '39/7 Đường 23, Hiệp Bình Chánh, Thủ Đức, TP. HCM',
                'email' => 'cskh@obn.land',
            ],
            [
                'id' => 2,
                'name' => 'OBN LAB',
                'phone' => '0932730394',
                'address' => '59/10 đường số 2, phường 3, quận Gò Vấp',
                'email' => 'cskh@obnlab.com',
            ],
        ];
        DB::table('supplier')->insert($data_supplier);
    }
}
