<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'description','price'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

//     public function isAvailable()
// {
//     // Check if the product has a positive quantity in any branch
//     return $this->stocks()->where('quantity', '>', 0)->exists();
// }

public function isAvailable($selectedRegion)
{
    // Check if the product has a positive quantity in any branch in the selected region
    return $this->stocks()
        ->whereHas('branch', function ($query) use ($selectedRegion) {
            $query->where('region', $selectedRegion);
        })
        ->where('quantity', '>', 0)
        ->exists();
}

public static function isAvailableInStoredRegion(Request $request, $productId)
{
    $storedRegion = $request->session()->get('selectedRegion');
    Log::info("Retrieved region from session: $storedRegion");

    $product = self::find($productId);

    if (!$product) {
        return false; // Handle the case where the product is not found.
    }

    Log::info("Checking availability for product $productId in region $storedRegion");

    $available = $product->stocks()
        ->whereHas('branch', function ($query) use ($storedRegion) {
            $query->where('region', $storedRegion);
        })
        ->where('quantity', '>', 0)
        ->exists();

    Log::info("Product $productId availability in region $storedRegion: " . ($available ? 'Available' : 'Not Available'));

    return $available;
}




    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }
}
