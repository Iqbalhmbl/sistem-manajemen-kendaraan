@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Data Pegawai</span>
    </div>
    <div class="card-body">
        <a href="{{ route('pegawai.create') }}" class="btn btn-sm btn-success mb-2">+ Add pegawai</a>
        <button class="btn btn-sm btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#importModal">
            Import Excel
        </button>
        <form method="GET" action="{{ route('pegawai.export') }}" style="display: inline;">
            <input type="hidden" name="fields[]" value="name">
            <input type="hidden" name="fields[]" value="phone">
            <input type="hidden" name="fields[]" value="website">
            <input type="hidden" name="fields[]" value="npwp">
            <input type="hidden" name="fields[]" value="notes">
            <input type="hidden" name="fields[]" value="contact_person">
            <input type="hidden" name="fields[]" value="address">
            <button type="submit" class="btn btn-sm btn-info mb-2">Export Excel</button>
        </form>
        
        <div class="p-1">
            <form method="GET" class="mb-3 d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Search name or phone..." value="{{ request('search') }}">
        
                <select name="sort_by" class="form-select">
                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="phone" {{ request('sort_by') == 'phone' ? 'selected' : '' }}>Phone</option>
                    <option value="website" {{ request('sort_by') == 'website' ? 'selected' : '' }}>Website</option>
                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Created At</option>
                </select>
        
                <select name="order" class="form-select">
                    <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>ASC</option>
                    <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>DESC</option>
                </select>
        
                <button class="btn btn-primary">Filter</button>
            </form>
        </div>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawais as $index => $pegawai)
                <tr>
                    <td>{{ $index + $pegawais->firstItem() }}</td>
                    <td>{{ $pegawai->nama }}</td>
                    <td>{{ $pegawai->jabatan }}</td>
                    <td>
                        <a href="{{ route('pegawai.show', $pegawai->id) }}" class="btn btn-sm btn-primary">Show</a>
                        <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus pegawai ini?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $pegawais->links() }}
    </div>
</div>
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('pegawai.import') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="importModalLabel">Import pegawai from Excel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label for="excelFile" class="form-label">Choose Excel File</label>
                  <input type="file" name="file" id="excelFile" class="form-control" required>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Import</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
