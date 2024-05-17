@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Employee List</h1>
        <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Add Employee</a>
        <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Import CSV</label>
                <input type="file" class="form-control" id="file" name="file">
            </div>
            <button type="submit" class="btn btn-primary">Import</button>
        </form>
        <a href="{{ route('employees.export.csv') }}" class="btn btn-success">Export CSV</a>
        <a href="{{ route('employees.export.pdf') }}" class="btn btn-danger">Export PDF</a>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Nomor</th>
                    <th>Jabatan</th>
                    <th>Departemen</th>
                    <th>Tanggal Masuk</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->nama }}</td>
                        <td>{{ $employee->nomor }}</td>
                        <td>{{ $employee->jabatan }}</td>
                        <td>{{ $employee->departemen }}</td>
                        <td>{{ $employee->tanggal_masuk }}</td>
                        <td><img src="{{ $employee->foto }}" height="50" width="50"></td>
                        <td>{{ $employee->status }}</td>
                        <td>
                            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
