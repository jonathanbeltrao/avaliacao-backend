<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService as ProductService;

class ProductsController extends Controller
{
    protected $productService;
    protected $loggedUser;


    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        $this->middleware(function ($request, $next){
            $this->loggedUser = request()->user();

            return $next($request);
        });
    }

    public function list(Request $request)
    {
        return response($this->productService->getProducts(), 200);
    }

    public function getFavorites(Request $request)
    {
        return response($this->productService->getFavorites($this->loggedUser->id), '200');
    }

    public function favorite(Request $request, $id)
    {
        return response(
            [
                'favorited' => $this->productService->favorite($this->loggedUser->id, $id)
            ],
            '200'
        );
    }
}
