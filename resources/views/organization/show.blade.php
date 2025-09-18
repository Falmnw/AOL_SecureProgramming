<h3>{{$organization->name}}</h3>
<a href="{{route('organization.candidate', $organization->id)}}">show candidate</a>
<a href="{{route('organization.member', $organization->id)}}">show member</a>
<a href="{{route('organization.give-role', $organization->id)}}">give role</a>
<a href="{{route('organization.store-email', $organization->id)}}">store email</a>
<a href="{{route('organization.store-candidate', $organization->id)}}">select candidate</a>

@if(session('error'))
    <script>alert('{{session("error")}}')</script>
@endif