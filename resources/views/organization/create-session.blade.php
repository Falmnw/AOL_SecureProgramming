<h3>Create Session</h3>
<form id="sessionForm" action="{{ route('organization.create-session', $organization->id) }}" method="POST">
    @csrf
    <label for="title">Judul Voting</label>
    <input type="text" name="title" id="title" required>

    <label for="start_time">Tanggal & Waktu Mulai</label>
    <input type="datetime-local" name="start_time" id="start_time" required>

    <label for="end_time">Tanggal & Waktu Berakhir</label>
    <input type="datetime-local" name="end_time" id="end_time" required>
    <h3>Select Candidate</h3>
    @foreach($organization->users as $user)
        <div style="display: flex;">
            <p>{{ $user->email }}</p>
            <input type="checkbox" name="user_id[]" value="{{ $user->id }}">
        </div>
    @endforeach
    <button type="submit">Buat Voting</button>
</form>

@if(session('success'))
<script>alert('{{session("success")}}')</script>
@endif
<script>
document.getElementById('sessionForm').addEventListener('submit', function (e) {
    const checkboxes = document.querySelectorAll('input[name="user_id[]"]:checked');
    if (checkboxes.length === 0) {
        e.preventDefault();
        alert("Harus pilih minimal 1 kandidat!");
    }
});
</script>