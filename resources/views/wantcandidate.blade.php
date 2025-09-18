@foreach($organizations as $organization)
    <form action="/store-candidate" method="post">
        @csrf
        <input type="hidden" name="organization_id" value="{{ $organization->id }}">
        <p>{{ $organization->id }}. {{ $organization->name }}</p><button type="submit">choose</button>
    </form>
@endforeach