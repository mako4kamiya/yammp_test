<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        // sql文で入れる方法
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

        // fakerを使う方法
        $faker = Faker\Factory::create();
        $data[] = [
            'studentNumber' => 2000,
            'userName'      => "test_user",
            'password'      => password_hash('testuser', PASSWORD_DEFAULT),
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'studentNumber' => $faker->numberBetween($min = 2001, $max = 2020),
                'userName'      => $faker->userName,
                'password'      => password_hash('faker', PASSWORD_DEFAULT),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];
        }
        $this->insert('users', $data);
    }
}
