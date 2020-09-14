<?php

namespace App\Http\Controllers;

use App\Models\DetailSoal;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailSoalController extends Controller
{
    public function create(Soal $soal)
    {
        // return $soal;
        return view('pages.umum.detail-soal.tambah', [
            'soal' => $soal,
            'layout' => 'admin'
        ]);
    }

    public function store(Request $request, $id)
    {
        $rules = [];

        for ($i = 1; $i <= count(request('soal')); $i++) {
            $rules['kunci_' . $i] = 'required|integer|in:1,2,3,4';
            $rules['gambar_' . $i] = 'image|max:2048';
        }


        $v = Validator::make($request->all(), [
            'soal' => 'required|array',
            'soal.*' => 'required|string|distinct',
            'jawaban' => 'required|array',
            'jawaban.*' => 'required|string|distinct',
            $rules
        ]);

        if ($v->fails()) {

            return redirect()->back()->withErrors($v);
        }

        for ($i = 1; $i <= count(request('soal')); $i++) {
            $question[] = [
                'soal_id' => $id,
                'soal' => request('soal')[$i - 1],
                'gambar' => request('gambar_' . $i),
                'randomize' => rand(1, 1000)
            ];

            if ($question[$i - 1]['gambar'] !== null) {
                $question[$i - 1]['gambar'] = $request->file('gambar_' . $i)->store('images/soal', 'public');
            }

            // DetailSoal::create($question[$i - 1]);
        }
        dd($question);

        return $request;
    }
}
