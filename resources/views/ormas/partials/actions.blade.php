<a href="{{ $editUrl }}" class="btn btn-sm btn-primary">Edit</a>
<form action="{{ $deleteUrl }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-sm btn-danger btn-delete">Hapus</button>
</form>

