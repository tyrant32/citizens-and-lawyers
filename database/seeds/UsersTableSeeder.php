<?php
declare(strict_types=1);

use App\Repositories\UsersRoleRepository;
use App\User;
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    /**
     * @var UsersRoleRepository
     */
    protected $usersRoleRepository;
    /**
     * @var \Faker\Generator
     */
    private $faker;
    
    /**
     * UsersTableSeeder constructor.
     */
    public function __construct(UsersRoleRepository $usersRoleRepository)
    {
        $this->faker = Faker\Factory::create();
        $this->usersRoleRepository = $usersRoleRepository;
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $citizenRole = $this->usersRoleRepository->findWhereIn(
            'slug',
            [
                'citizen'
            ],
            [
                'id'
            ]
        )->first();
        
        $lawyerRole = $this->usersRoleRepository->findWhereIn(
            'slug',
            [
                'lawyer'
            ],
            [
                'id'
            ]
        )->first();
        
        if (!User::count()) {
            if ($citizenRole) {
                User::create([
                    'role_id'  => $citizenRole->id,
                    'name'     => $this->faker->name,
                    'email'    => 'citizen@demo.com',
                    'password' => bcrypt('demo'),
                ]);
            }
            
            if ($lawyerRole) {
                User::create([
                    'role_id'  => $lawyerRole->id,
                    'name'     => $this->faker->name,
                    'email'    => 'lawyer@demo.com',
                    'password' => bcrypt('demo'),
                ]);
            }
            
        }
    }
}
