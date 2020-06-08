
@inject('users', 'App\Repository\UserRepositoryInterface')

<span class="dropdown">
    <button class="btn {{ $user ? 'btn-outline-info': 'btn-outline-success'}}  btn-sm  text-center dropdown-toggle assign"
            type="button" id="triggerId" data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
        <i class="init-icon fa fa-user-circle"></i>
        @if(!$user)
            Re-assign
        @else
            Assign
        @endif
    </button>
    <div class="dropdown-menu" aria-labelledby="triggerId">
        @foreach($users->getLawyersOnly() as $lawyer)
            <a class="dropdown-item" id="{{ $lawyer->id }}" href="#">{{ $lawyer->profile->username }}</a>
        @endforeach
    </div>
</span>

