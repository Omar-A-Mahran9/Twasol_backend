<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
 use App\Http\Resources\Api\BlogResource;

use App\Http\Resources\Api\GallariesResource;
use App\Http\Resources\Api\OfferResource;
use App\Http\Resources\Api\PartenersResource;

use App\Http\Resources\Api\SliderResource;

use App\Models\award;
use App\Models\blogs;

use App\Models\Gallary;
use App\Models\NewsLetter;
use App\Models\Offer;
use App\Models\partener;
 use App\Models\Slider;

=======
use App\Http\Resources\Api\CitiesResource;
use App\Http\Resources\Api\CommonQuestionResource;
use App\Http\Resources\Api\HowuseResource;
use App\Http\Resources\Api\ServiceResource;
use App\Http\Resources\Api\SliderResource;

use App\Http\Resources\Api\WhyusResource;

use App\Models\AddonService;
use App\Models\City;
use App\Models\CommonQuestion;
use App\Models\Howuse;
use App\Models\NewsLetter;

use App\Models\Slider;

use App\Models\Whyus;
>>>>>>> dbb27197de73dcd514bc9d13aff284f8d17381d1
use Illuminate\Http\Request;

class HomeController extends Controller
{
<<<<<<< HEAD


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
=======

>>>>>>> dbb27197de73dcd514bc9d13aff284f8d17381d1


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


    public function getservices()
    {
        $services = AddonService::where('is_publish', '1')->get();

        return $this->success('', ServiceResource::collection($services));
    }
<<<<<<< HEAD
=======

    public function getwhyus()
    {
        $Whyus = Whyus::get();

        return $this->success('', WhyusResource::collection($Whyus));
    }
    public function getcities()
    {
        $cities = City::get();

        return $this->success('', CitiesResource::collection($cities));
    }
    
    public function getQuestions()
    {
        $CommonQuestion = CommonQuestion::get();

        return $this->success('', CommonQuestionResource::collection($CommonQuestion));
    }

    public function getMakeOrder()
    {
        $makeOrder = Howuse::get();

        return $this->success('', HowuseResource::collection($makeOrder));
    }
>>>>>>> dbb27197de73dcd514bc9d13aff284f8d17381d1
}
