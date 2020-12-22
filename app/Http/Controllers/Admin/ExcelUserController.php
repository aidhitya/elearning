<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\MuridImport;
use App\Imports\GuruImport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExcelUserController extends Controller
{
    public function murid(Request $request)
    {
        $this->validate($request, [
            'excel' => 'file|mimes:xlsx|max:2048'
        ]);

        $data = $request->all();
        $data['excel'] = $request->file('excel')->store('users/excel', 'public');

        $excel =  storage_path('app/public/' . $data['excel']);

        Excel::import(new MuridImport(), $excel);
        Storage::delete('public/' . $data['excel']);

        return redirect()->back()->with('success', 'Murid berhasil ditambahkan');
    }

    public function guru(Request $request)
    {
        $this->validate($request, [
            'excel' => 'file|mimes:xlsx|max:2048'
        ]);

        $data = $request->all();
        $data['excel'] = $request->file('excel')->store('users/excel', 'public');

        $excel =  storage_path('app/public/' . $data['excel']);
        Excel::import(new GuruImport(), $excel);
        Storage::delete('public/' . $data['excel']);

        return redirect()->back()->with('success', 'Guru berhasil ditambahkan');
    }
}
