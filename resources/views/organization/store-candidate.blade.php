<h3>Select Candidate</h3>

<form action="{{ route('organization.store-candidate', $organization->id)}}" method="post">
    @foreach($organization->users as $user)
    @csrf
        <div style="display: flex;">
            <p>{{ $user->email }}</p>
            <input type="checkbox" name="user_id[]" value="{{ $user->id }}">
        </div>
    @endforeach
    <input type="hidden" name="organization_id" value="{{ $organization->id }}">
    <button type="submit">Apply</button>
</form>
