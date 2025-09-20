@if($sesi)
    @if($organization->getRoleUser() == 'Admin')
    <form action="{{ route('organization.delete-session', $organization->id) }}">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
    </form>
    @endif


    @if(now()->lessThan($sesi->start_time))
        <p class="text-blue-500">Voting akan dibuka pada {{ $sesi->start_time->format('d M Y H:i') }}</p>
    @elseif(now()->greaterThan($sesi->end_time))
        <p class="text-red-500">Voting sudah berakhir ({{ $sesi->end_time->format('d M Y H:i') }})</p>
        <p>{{$winner->user->name}}</p>
    @else
        <p class="text-green-500">Voting sedang berlangsung (hingga {{ $sesi->end_time->format('d M Y H:i') }})</p>
        @foreach($organization->candidates as $candidate)
            <form action="{{ route('organization.store-vote', $organization->id)}}" method="post" style="display: flex;">
                @csrf
                <input type="hidden" name="organization_id" value="{{ $organization->id }}">
                <input type="hidden" name="candidate_id" value="{{ $candidate->user_id }}">
                <p>{{ $candidate->user->name }}</p>
                <button type="submit">Vote {{ $candidate->user_id }}</button>
            </form>
        @endforeach
    @endif
@else
    <p>Gk ada Sesi</p>
@endif
