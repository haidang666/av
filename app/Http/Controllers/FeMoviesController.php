<?php

namespace App\Http\Controllers;

use app\Repositories\ActressRepository;
use app\Repositories\MovieRepository;
use app\Repositories\StudioRepository;
use app\Repositories\TagRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class FeMoviesController extends Controller
{
    protected $movieRepository;
    protected $studioRepository;
    protected $actressRepository;
    protected $tagRepository;

    protected $indexOrder = ['order' => ['col' => 'release',
        'dir' => 'desc']];

    public function __construct(MovieRepository $movieRepo,
                                StudioRepository $studioRepo,
                                ActressRepository $actressRepo,
                                TagRepository $tagRepo)
    {
        $this->movieRepository = $movieRepo;
        $this->studioRepository = $studioRepo;
        $this->actressRepository = $actressRepo;
        $this->tagRepository = $tagRepo;
    }

    public function index(Request $request){
        $perPage = $request->input('perPage', 24);
        if(isset($request->q)){
            $this->indexOrder['q'] = ['field' => 'code',
                'value' => $request->q];
        }

        $movies = $this->movieRepository->paginate($perPage, $this->indexOrder);

        if(isset($request->q)){
            $movies->appends(['q' => $request->q]);
        }

        return view('frontend.movies.index', [
            'movies' => $movies,
        ]);
    }

    public function show($code, Request $request){
        $attribute = 'code';
        $value = $code;
        if(isset($request->id)){
            $attribute = 'id';
            $value = $request->id;
        }
        try{
            $movie = $this->movieRepository->findBy($attribute, $value);
            $actresses = $movie->actresses;
            $tags = $movie->tags;
        }catch (\Exception $e){
            return view('frontend.errors.404');
        }

        return view('frontend.movies.show', [
            'actresses' => $actresses,
            'movie' => $movie,
            'tags' => $tags]);
    }
}
