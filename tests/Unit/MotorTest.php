<?php

namespace Tests\Unit;

use Auth;
use JWTAuth;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\MotorRepository AS Repo;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Faker\Factory as Faker;
use Tests\TestCase;

class MotorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     /** @test */
    public function list_motor()
    {
        $response = $this->get('api/motor');
        $response->assertStatus(200);
    }

    /** @test */
    public function create_motor()
    {
        // init user
        $user = User::factory->create([
            'email' => 'dinda@gmail.com',
            'password' => bcrypt('dinda123')
        ]);

        $token=JWTAuth::fromUser($user);
        $faker = Faker::create();
        $data = [
            'nama' => $faker->sentence,
            'mesin' => $faker->sentence,
            'tipe_suspensi' => $faker->sentence,
            'tipe_tranmisi' => $faker->sentence,
            'stock' => 4,
            'id_kendaraan' => 1,
        ];
        $this->post(route('motor.create', ['Authorization' => "Bearer $token"]), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

     /** @test */
    public function detail_motor()
    {
        $response = $this->get('api/motor/id');
        $response->assertStatus(200);
    }

    /** @test */
    public function penjualan_motor()
    {
        // init user
        $user = User::factory->create([
            'email' => 'dinda@gmail.com',
            'password' => bcrypt('dinda123')
        ]);

        $token=JWTAuth::fromUser($user);
        $data = [
            'id_motor' => 1,
            'tanggal' => "21/09/09",
            'harga_jual' => $faker->sentence,
        ];

        $this->post(route('motor.penjualan', ['Authorization' => "Bearer $token"]), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /** @test */
    public function laporan_penjualan()
    {
        $response = $this->get('api/laporanmotor');
        $response->assertStatus(200);
    }

    /** @test */
    public function detail_penjualan()
    {
        $response = $this->get('api/laporanmotor');
        $response->assertStatus(200);
    }
}
