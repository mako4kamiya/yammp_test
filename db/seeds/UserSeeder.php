<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        // $sql = "INSERT INTO users
        //     (
        //         studentNumber,
        //         userName,
        //         password,
        //         created_at,
        //         updated_at
        //     )
        //     VALUES
        //     (
        //         2000,
        //         'sampleName', 
        //         '$2y$10$4d.iyXojEfKrHTLhRVswEOALkPJt3DX69oqzJDBIaMUDIcBGOT7SK',
        //         NOW(),
        //         NOW()
        //     );";
        // $this->execute($sql);

        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'studentNumber' => $faker->numberBetween($min = 2001, $max = 2020),
                'userName'      => $faker->userName,
                'password'      => $faker->sha256('foo'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => $faker->lastName,
            ];
        }
        $this->insert('users', $data);
    }
}
