<?php


namespace App\Http\View\Composers;



use App\Facade\FileRepository;
use Illuminate\View\View;

class FileComposer
{
    public function compose(View $view)
    {
        return $view->with(['files' => $this->getFiles(),] );
    }

    public function getFiles()
    {
        return FileRepository::allFiles();
    }
}
