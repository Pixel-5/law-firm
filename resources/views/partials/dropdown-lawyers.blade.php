
@inject('users', 'App\Repository\UserRepositoryInterface')

<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    @foreach($users->getLawyersOnly() as $lawyer)
    <a class="dropdown-item" id="{{ $lawyer->id }}" href="#">{{ $lawyer->name }} {{ $lawyer->surname }}</a>
    @endforeach
</div>

