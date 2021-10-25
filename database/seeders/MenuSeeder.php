<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $names = ['Home', 'Contact', 'Author', 'Admin', 'Login'];
    private $routes = ['home','contact','author','admin.index','login'];

    public function run()
    {
        for($i=0; $i<count($this->names); $i++){
            \DB::table('menus')->insert([
                'name' => $this->names[$i],
                'route' => $this->routes[$i]
            ]);
        }
        
    
    }
}
