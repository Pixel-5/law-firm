<?php

namespace App\Http\Controllers;

use App\Company;
use App\Conveyancing;
use App\File;
use App\FileCase;
use App\Individual;
use App\Litigation;
use App\Plot;
use App\PlotTransaction;
use App\Retainer;
use App\User;
use Spatie\Searchable\ModelSearchAspect;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function __invoke()
    {
        $search = (new Search())
            ->registerModel(User::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                    ->addSearchableAttribute('name') // return results for partial matches on usernames
                    ->addSearchableAttribute('surname') // return results for partial matches on surnames
                    ->addSearchableAttribute('contact')
                    ->addExactSearchableAttribute('email'); // only return results that exactly match the e-mail
            })
            ->registerModel(Litigation::class, function(ModelSearchAspect $modelSearchAspect) {
                    $modelSearchAspect
                        ->addSearchableAttribute('number')
                        ->addSearchableAttribute('status')
                        ->addSearchableAttribute('category');
                })
            ->registerModel(Conveyancing::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                    ->addSearchableAttribute('number')
                    ->addSearchableAttribute('status');
            })
            ->registerModel(Individual::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                    ->addSearchableAttribute('number')
                    ->addSearchableAttribute('surname')
                    ->addSearchableAttribute('name')
                    ->addSearchableAttribute('identifier')
                    ->addSearchableAttribute('email')
                    ->addSearchableAttribute('cell');
            })
            ->registerModel(Company::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                    ->addSearchableAttribute('number')
                    ->addSearchableAttribute('name')
                    ->addSearchableAttribute('email');
            })
            ->registerModel(Retainer::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                    ->addSearchableAttribute('number');
            })
            ->search( request('query'));

       return view('search-results')->with('searchResults',$search);
    }
}
