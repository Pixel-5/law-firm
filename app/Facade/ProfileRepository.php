<?php


    namespace App\Facade;


    use Illuminate\Support\Facades\Facade;

    class ProfileRepository extends Facade
    {
        /**
         * @return string
         */
        protected static function getFacadeAccessor()
        {
            return 'ProfileRepository';
        }
    }