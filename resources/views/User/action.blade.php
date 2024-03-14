<a type="button" href="{{ route('user.edit', $model->id) }}" class="btn btn-sm mb-1 me-1 btn-warning btn-active-light-warning">
    Edit
</a>
<a type="button" href="{{ route('user.delete', $model->id) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-sm mb-1 me-1 btn-danger btn-active-light-danger">
    Hapus
</a>