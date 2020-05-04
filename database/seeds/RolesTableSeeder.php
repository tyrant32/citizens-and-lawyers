<?php
declare(strict_types=1);

use App\Entities\UsersRole;
use Illuminate\Database\Seeder;

/**
 * Class RolesTableSeeder
 */
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!UsersRole::count()) {
            
            UsersRole::create([
                'slug'  => 'citizen',
                'title' => 'Citizen',
            ]);
            
            UsersRole::create([
                'slug'  => 'lawyer',
                'title' => 'Lawyer',
            ]);
            
        }
    }
}
