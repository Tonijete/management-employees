<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use League\Csv\Writer;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::all();

        if ($request->wantsJson()) {
            return response()->json($employees);
        }

        return view('employees.index', compact('employees'));
    }
    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'departemen' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'foto' => 'nullable|image',
            'status' => 'required|in:Kontrak,Tetap,Probation',
        ]);

        $data = $request->all();
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('photos', 'public');
        }

        $employee = Employee::create($data);

        if ($request->wantsJson()) {
            return response()->json($employee, 201);
        } else {
            return redirect()->route('employees.index')->with('success', 'Employee added successfully');
        }
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function show($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            return response()->json($employee);
        } else {
            return response()->json(['error' => 'Employee not found'], 404);
        }
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'departemen' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'foto' => 'nullable|image',
            'status' => 'required|in:Kontrak,Tetap,Probation',
        ]);

        $data = $request->all();
        if ($request->hasFile('foto')) {
            if ($employee->foto) {
                Storage::disk('public')->delete($employee->foto);
            }
            $data['foto'] = $request->file('foto')->store('photos', 'public');
        }

        $employee->update($data);

        if ($request->wantsJson()) {
            return response()->json($employee);
        } else {
            return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
        }
    }

    public function destroy(Employee $employee)
    {
        if ($employee->foto) {
            Storage::disk('public')->delete($employee->foto);
        }
        $employee->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        } else {
            return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
        }
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $path = $request->file('file')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $header = array_shift($data);
        foreach ($data as $row) {
            $employeeData = array_combine($header, $row);
            Employee::create($employeeData);
        }

        return redirect()->route('employees.index')->with('success', 'Employees imported successfully');
    }

    public function exportCSV(Request $request)
    {
        $employees = Employee::all();

        $csv = Writer::createFromString('');
        $csv->insertOne(['Nama', 'Nomor', 'Jabatan', 'Departemen', 'Tanggal Masuk', 'Foto', 'Status']);

        foreach ($employees as $employee) {
            $csv->insertOne([
                $employee->nama,
                $employee->nomor,
                $employee->jabatan,
                $employee->departemen,
                $employee->tanggal_masuk,
                $employee->foto,
                $employee->status
            ]);
        }

        $csvData = $csv->__toString();

        if ($request->wantsJson()) {
            return response()->json($csvData, 200);
        } else {
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="employees.csv"',
            ];

            return new StreamedResponse(function () use ($csvData) {
                echo $csvData;
            }, 200, $headers);
        }
    }

    public function exportPDF()
    {
        $employees = Employee::all();
        $pdf = PDF::loadView('employees.pdf', compact('employees'));
        return $pdf->download('employees.pdf');
    }
}
