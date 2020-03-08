<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Favorite;
use App\User;
use App\Events\SendFavoriteListEvent;

class ProductService
{
    protected $url;
    public function __construct()
    {
        $this->url = "https://" . getenv("SHOPIFY_API_KEY") . ":" .
                                  getenv("SHOPIFY_API_PASSWORD") .
                                  "@send4-avaliacao.myshopify.com/admin/api/2020-01/products.json";
    }

    public function getProducts() : Array
    {
        try{
            $json = json_decode(file_get_contents($this->url));
            return $json->products;
        }catch(\Exception $exception){
            return [
                'message' => $exception->getMessage()
            ];
        }
    }

    public function getFavorites($user_id) : Array
    {
        $products = $this->getProducts();
        $favorites = Favorite::where('user_id', '=', $user_id)->get();
        $product_ids = $favorites->pluck('product_id')->toArray();

        return array_filter($products, function ($product) use ($product_ids) {
            return in_array($product->id, $product_ids);
        });
    }

    public function favorite($user_id, $product_id){

        $return = false; 

        $fav = Favorite::where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->first();

        $user = User::find($user_id);

        if(empty($fav)){
            $favorite = Favorite::create([
                'user_id' => $user_id,
                'product_id' => $product_id
            ]);

            $return = true;
        }else{
            $favorite = $fav;
            Favorite::destroy($fav->id);
        }

        event(new SendFavoriteListEvent($user, $this->getFavorites($user_id)));

        return $return;
    }
}
