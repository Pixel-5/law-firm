<?php


namespace App\Mixins;


use Illuminate\Support\Str;

class StrMixins
{
    public function fileNumber()
    {
        return function (){
            $file = Str::random(8);
            return Str::upper('FS-'. substr($file,0,3). '-'. substr($file,3));
        };

    }

    public function caseNumber()
    {
        return function (){
            $case = Str::random(8);
            return 'CA-'. substr($case,0,3). '-'. substr($case,3);
        };

    }
}
