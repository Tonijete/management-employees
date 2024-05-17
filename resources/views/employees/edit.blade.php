@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Employee</h1>
        <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama" class="form-label">Name</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $employee->nama }}">
            </div>
            <div class="mb-3">
                <label for="nomor" class="form-label">Nomor</label>
                <input type="text" class="form-control" id="nomor" name="nomor" value="{{ $employee->nomor }}">
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $employee->jabatan }}">
            </div>
            <div class="mb-3">
                <label for="departemen" class="form-label">Departemen</label>
                <input type="text" class="form-control" id="departemen" name="departemen" value="{{ $employee->departemen }}">
            </div>
            <div class="mb-3">
                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{ $employee->tanggal_masuk }}">
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
                @if($employee->foto)
                    <img src="{{ $employee->foto }}"  width="100">
                @endif
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="Kontrak" {{ $employee->status == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                    <option value="Tetap" {{ $employee->status == 'Tetap' ? 'selected' : '' }}>Tetap</option>
                    <option value="Probation" {{ $employee->status == 'Probation' ? 'selected' : '' }}>Probation</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
