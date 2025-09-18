<h3>Daftar Organisasi:</h3>
@foreach($organizations as $organization)
    <form action="/pick-organization" method="POST" style="display:flex;">
        @csrf
        <input type="hidden" name="organization_id" value="{{ $organization->id }}">
        <p>{{ $organization->id }}. {{ $organization->name }}</p><button type="submit">choose</button>
    </form>
@endforeach