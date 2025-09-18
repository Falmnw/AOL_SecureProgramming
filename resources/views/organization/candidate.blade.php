<h3>daftar kandidat</h3>
@if(session('error'))
    <script>alert('{{session("error")}}')</script>
@endif
<form action="{{ route('organization.store-vote', $organization->id)}}" method="post">
    <input type="hidden" name="user_id" value="{{$user->id}}">
    <input type="hidden" name="organization_id" value="{{$organization->id}}">
    @foreach($organization->candidates as $candidate)
        @csrf
        <div style="display: flex;">
            <p>{{ $candidate->user->name }}</p>
            <input type="hidden" name="candidate_id" value="{{ $candidate->user->id }}">
            <button type="submit">Vote</button>
        </div>
    @endforeach
</form>
