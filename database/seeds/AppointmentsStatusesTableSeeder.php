<?php
declare(strict_types=1);

use App\Entities\AppointmentsStatus;
use Illuminate\Database\Seeder;

/**
 * Class AppointmentsStatusesTableSeeder
 */
class AppointmentsStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!AppointmentsStatus::count()) {
            
            AppointmentsStatus::create([
                'slug'  => 'approved',
                'title' => 'Approved',
            ]);
            
            AppointmentsStatus::create([
                'slug'  => 'rejected',
                'title' => 'Rejected',
            ]);
            
        }
    }
}
