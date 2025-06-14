<a href="{{ route('ormas.show', $row->id) }}" class="btn btn-sm btn-info">Detail</a>
<a href="{{ route('ormas.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
<form action="{{ route('ormas.destroy', $row->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
</form>
