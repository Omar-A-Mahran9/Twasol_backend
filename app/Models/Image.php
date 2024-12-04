<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'car_images';
    protected $guarded = [];
    protected $appends = ['full_image_path'];
    protected $casts   = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d'];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope);
    }

    public function car()
    {
        return $this->belongsTo(Cars::class);
    }

    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->name, 'CarImages', "placeholder.png"));
    }

    public static function handleProductImages($carID)
    {
        $deletedImages = json_decode(request()->deleted_images ?? "[]");
        $newProductImages = request()->images ?? [];

        foreach ($newProductImages as $imageFile) {
            Image::create([
                'car_id' => $carID,
                'name' => uploadImageToDirectory($imageFile, 'CarImages'),
            ]);
        }
        /** remove deleted product images from storage folder**/
        foreach ($deletedImages as $imageName) {
            deleteImageFromDirectory($imageName, 'CarImages');
            Image::where('car_id', $carID)->where('name', $imageName)->delete();
        }
    }
}
