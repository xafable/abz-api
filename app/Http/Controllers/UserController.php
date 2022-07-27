<?php

namespace App\Http\Controllers;

use App\Http\Middleware\FilterPaginateApi;
use App\Http\Requests\UserPostRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Rules\LessThan5;
use App\Services\Tinify;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

    function __construct()
    {
        $this->middleware(function ($request, $next) {

            $userId = $request->route()->parameter('user');

            if(!is_numeric($userId))
                return response()->json([
                    'success' => false,
                    'message'=> 'Validation failed.',
                    'fails'=> ['user_id' => $request->user .'. The user_id must be an integer.']
                ], 422);
            else
               return $next($request);
        })->only(['show']);


        $this->middleware(function ($request, $next) {

            $fails = [];
            $page = $request->page;
            $count = $request->count;

            if(isset($count) && !is_null($count) && !is_numeric($count))
                $fails['count'] = 'The count must be an integer.';

            if(isset($page) && !is_null($page) && $page < 1)
                $fails['page'] = 'The page must be at least 1.';


            if($fails){
                return response()->json([
                    'f' => $count,
                    'success' => false,
                    'message'=> 'Validation failed.',
                    'fails'=> $fails
                ], 422);
            }
            return $next($request);

        })->only(['index']);

       $this->middleware(FilterPaginateApi::class)->only('index');
       $this->middleware('auth:sanctum')->only('store');
    }


    function index(Request $request){
        if(isset($request->count) && !is_null($request->count))
            $count = $request->count;
        else $count = 3;

        $resourceCollection = new UserCollection(User::query()->where('type', '<>','system')->paginate($count));

        return  $resourceCollection;
    }

    function show($id,Request $request){


        return response()->json([
            'success' => true,
            'user' => new UserResource(User::query()->findOrFail($id)),
        ]);
    }

    function store(UserPostRequest $request,Tinify $tinify){
        $path = 'storage/images/';

        $user = User::query()->create([
                'name'=> $request->name,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'position_id'=> $request->position_id,
                'password' => Hash::make('1234q'),
            ]);

        $imageName = $user->id.'_photo_'.Carbon::now()->day.'.jpg';
        $request->photo->storeAs('images', $imageName,'public');

        $tinify->resizeAndSave($path,$imageName);

        return response()->json([
            'success' => $user->id,
        ]);

    }
}
