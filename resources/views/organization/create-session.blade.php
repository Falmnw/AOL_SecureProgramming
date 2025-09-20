<h3>Select Candidate</h3>
<form action="{{ route('organization.create-session', $organization->id) }}" method="POST">
    @csrf
    <label for="title">Judul Voting</label>
    <input type="text" name="title" id="title" required>

    <label for="start_time">Tanggal & Waktu Mulai</label>
    <input type="datetime-local" name="start_time" id="start_time" required>

    <label for="end_time">Tanggal & Waktu Berakhir</label>
    <input type="datetime-local" name="end_time" id="end_time" required>

    <button type="submit">Buat Voting</button>
</form>
@if(session('success'))
<script>alert('session("success")')</script>
@endif