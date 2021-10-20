<?php

namespace Tests\Unit;

use Auth;
use JWTAuth;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\MobilRepository AS Repo;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Faker\Factory as Faker;
use Tests\TestCase;

class MobilTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     /** @test */
    public function list_mobil()
    {
        $response = $this->get('api/mobil');
        $response->assertStatus(200);
    }

    /** @test */
    public function create_mobil()
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
        $this->post(route('mobil.create', ['Authorization' => "Bearer $token"]), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

     /** @test */
    public function detail_mobil()
    {
        $response = $this->get('api/mobil/id');
        $response->assertStatus(200);
    }

    /** @test */
    public function penjualan_mobil()
    {
        // init user
        $user = User::factory->create([
            'email' => 'dinda@gmail.com',
            'password' => bcrypt('dinda123')
        ]);

        $token=JWTAuth::fromUser($user);
        $data = [
            'id_mobil' => 1,
            'tanggal' => "21/09/09",
            'harga_jual' => $faker->sentence,
        ];

        $this->post(route('mobil.penjualan', ['Authorization' => "Bearer $token"]), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    /** @test */
    public function laporan_penjualan()
    {
        $response = $this->get('api/laporanmobil');
        $response->assertStatus(200);
    }

    /** @test */
    public function detail_penjualan()
    {
        $response = $this->get('api/laporanmobil');
        $response->assertStatus(200);
    }
}
