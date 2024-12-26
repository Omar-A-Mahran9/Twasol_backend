<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AdResource;
use App\Http\Resources\Api\BlogResource;
use App\Http\Resources\Api\BrandResource;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\GallariesResource;
use App\Http\Resources\Api\OfferResource;
use App\Http\Resources\Api\PartenersResource;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\QuestionResource;
use App\Http\Resources\Api\SliderResource;
use App\Http\Resources\Api\SubcategoryResource;
use App\Http\Resources\Api\TagResource;
use App\Models\Ad;
use App\Models\award;
use App\Models\blogs;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonQuestion;
use App\Models\Gallary;
use App\Models\NewsLetter;
use App\Models\Offer;
use App\Models\partener;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
 

    public function getblogs()
    {
        $blogs = blogs::get();

        return $this->success('', BlogResource::collection($blogs));
    }

    public function getawards()
    {
        $blogs = award::get();

        return $this->success('', BlogResource::collection($blogs));
    }

    public function getpartners()
    {
        $partner = partener::get();

        return $this->success('', PartenersResource::collection($partner));
    }
    public function getGalleryById($id)
    {
        // Fetch the gallery by ID
        $gallery = Gallary::where('addon_service_id',$id)->get();

        // Check if the gallery exists
        if (!$gallery) {
            return $this->error('Gallery not found', 404);
        }

        // Return the specific gallery using the resource
        return $this->success('', GallariesResource::collection($gallery));
    }
    public function getgallaries()
    {
        $gallary = Gallary::get();

        return $this->success('', GallariesResource::collection($gallary));
    }

    public function getblog($id)
    {
        $blog = blogs::find($id);

        $relatedBlogs = blogs::where('id', '!=', $id)
        ->inRandomOrder()
        ->take(5)
        ->get();

        $blog['relatedBlogs']= $relatedBlogs;
 
        return $this->success('', $blog);
    }


    public function newsLetter(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email:rfc,dns', 'unique:news_letters'],
        ]);

        NewsLetter::create([
            'email' => $request->email
        ]);

        return $this->success(__('Created Successfully'));
    }

    public function getSliders()
    {
        $sliders = Slider::where('status', '1')->get();

        return $this->success('', SliderResource::collection($sliders));
    }

    public function getOffers()
    {
        $sliders = Offer::where('status', 'Approved')->get();

        return $this->success('', OfferResource::collection($sliders));
    }
}