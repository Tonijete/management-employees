<!DOCTYPE html>
<html>
<head>
    <title>Employees List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Employees List</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Nomor</th>
                <th>Jabatan</th>
                <th>Departemen</th>
                <th>Tanggal Masuk</th>
                <th>Foto</th>
                <th>Status</th>
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
                    <td><img src="{{ public_path('storage/' . $employee->foto) }}" alt="{{ $employee->name }}" width="50"></td>
                    <td>{{ $employee->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
