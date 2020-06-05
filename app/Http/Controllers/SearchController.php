<?php

namespace App\Http\Controllers;

use App\File;
use App\FileCase;
use App\User;
use Illuminate\Http\Request;
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
                    ->addSearchableAttribute('surname') // return results for partial matches on surrnames
                    ->addSearchableAttribute('contact')
                    ->addExactSearchableAttribute('email'); // only return results that exactly match the e-mail
            })
            ->registerModel(File::class, function(ModelSearchAspect $modelSearchAspect) {
                    $modelSearchAspect
                        ->addSearchableAttribute('number')
                        ->addSearchableAttribute('name')
                        ->addSearchableAttribute('gender')
                        ->addSearchableAttribute('surname')
                        ->addSearchableAttribute('dob');
                })

            ->registerModel(FileCase::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                    ->addSearchableAttribute('number')
                    ->addSearchableAttribute('plaintiff')
                    ->addSearchableAttribute('defendant')
                    ->addSearchableAttribute('details')
                    ->addSearchableAttribute('status')
                    ->addSearchableAttribute('docs');
            })
            ->search( request('query'));

       return view('search-results')->with('searchResults',$search);
    }
}
