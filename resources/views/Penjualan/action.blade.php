<a type="button" href="{{ route('sales.detail', $model->id) }}" class="btn btn-sm mb-1 me-1 btn-warning btn-active-light-warning">
    Detail
</a>
<a type="button" href="{{ route('sales.delete', $model->id) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-sm mb-1 me-1 btn-danger btn-active-light-danger">
    Hapus
</a>