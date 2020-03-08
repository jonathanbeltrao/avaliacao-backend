<?php

namespace Tests\Feature;

use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testFavorite()
    {
        $productService = new ProductService();
        $userService = new UserService();

        $user = $userService->create([
            'name' => 'Jonathan Beltrão',
            'email' => 'jonathanbeltrao@gmail.com',
            'password' => '12345678',
        ]);

        $productService->favorite($user->id, '4543367512203');
        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'product_id' => '4543367512203'
        ]);

        $productService->favorite($user->id, '4543367512203');
        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'product_id' => '4543367512203'
        ]);
    }

    public function testGetFavorites(){
        $productService = new ProductService();
        $userService = new UserService();

        $user = $userService->create([
            'name' => 'Jonathan Beltrão',
            'email' => 'jonathanbeltrao@gmail.com',
            'password' => '12345678',
        ]);

        $productService->favorite($user->id, '4543367512203');
        $productService->favorite($user->id, '4543373377675');
        $productService->favorite($user->id, '4543380816011');

        $productIds = ['4543367512203', '4543373377675', '4543380816011'];

        $favorites = $productService->getFavorites($user->id);

        $this->assertIsArray($favorites);
        foreach($favorites as $fav){
            $this->assertTrue(in_array($fav->id, $productIds));
        }
    }
}
