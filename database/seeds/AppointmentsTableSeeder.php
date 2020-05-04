<?php
declare(strict_types=1);

use App\Entities\AppointmentsStatus;
use App\Entities\Аppointment;
use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

/**
 * Class AppointmentsTableSeeder
 */
class AppointmentsTableSeeder extends Seeder
{
    /**
     * @var Factory
     */
    private $faker;
    
    /**
     * AppointmentsTableSeeder constructor.
     */
    public function __construct(Factory $faker)
    {
        $this->faker = $faker->create();
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lawyer = User::join('users_roles', 'users_roles.id', '=', 'users.role_id')
            ->where('users_roles.slug', 'lawyer')
            ->first(['users.id']);
        
        $citizen = User::join('users_roles', 'users_roles.id', '=', 'users.role_id')
            ->where('users_roles.slug', 'citizen')
            ->first();
        
        if (!Аppointment::count()) {
            
            Аppointment::create([
                'user_id'   => $citizen->id,
                'lawyer_id' => $lawyer->id,
                'status_id' => AppointmentsStatus::inRandomOrder()->first()->id,
                'time'      => $this->faker->dateTime()
            ]);
            
        }
    }
}
