<form action="{{ route('organization.store-email', $organization->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="csv_file" accept=".csv">
    <button type="submit">Upload</button>
</form>
