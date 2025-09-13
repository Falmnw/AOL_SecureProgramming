<a href="{{ url('/auth/redirect') }}" class="btn btn-danger">
    <i class="fab fa-google"></i> Login dengan Google
</a>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
