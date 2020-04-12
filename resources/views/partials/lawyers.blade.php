
<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    @foreach($lawyers as $lawyer)
    <a class="dropdown-item" href="#">{{ $lawyer->name }}</a>
    @endforeach
</div>

