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
                    ->addExactSearchableAttribute('email'); // only return results that exactly match the e-mail address
            })
            ->registerModel(File::class,[
                'number',
                'name',
                'surname',
                'gender',
                'email',
                'dob',
            ])
            ->registerModel(FileCase::class, [
                'plaintiff',
                'defendant',
                'details',
                'status',
                'number',
                'docs',
            ])
            ->search( request('query'));

       return view('search-results')->with('searchResults',$search);
    }
}
