<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailSoalRequest;
use App\Imports\SoalImport;
use App\Models\DetailSoal;
use App\Models\Jawaban;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

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

    public function store(DetailSoalRequest $request, $id)
    {
        $count = count(request('soal'));

        for ($i = 1; $i <= $count; $i++) {

            // create soal
            $question[] = [
                'soal_id' => $id,
                'soal' => request('soal')[$i - 1],
                'gambar' => request('gambar_' . $i),
                'randomize' => rand(1, 1000)
            ];

            if ($question[$i - 1]['gambar'] !== null) {
                $question[$i - 1]['gambar'] = $request->file('gambar_' . $i)->store('images/soal', 'public');
            }

            $soal = DetailSoal::create($question[$i - 1]);

            $key = request('kunci_' . $i);
            for ($j = 1; $j <= count(request('jawaban_' . $i . '_')); $j++) {
                $kunci = 0;
                if ($key == $j) {
                    $kunci = 1;
                }

                // create jawaban
                $answers[$i][] = [
                    'detail_soal_id' => $soal->id,
                    'jawaban' => request('jawaban_' . $i . '_')[$j - 1],
                    'kunci' => $kunci,
                    'randomize' => rand(1, 1000)
                ];
            }

            Jawaban::insert($answers[$i]);
        }

        return redirect()->back()->with('berhasil', 'Soal Berhasil Dibuat');
    }

    public function edit(DetailSoal $detail)
    {
        $detail->load(['soalnya', 'jawabans']);
        return view('pages.umum.detail-soal.edit', [
            'detail' => $detail,
            'layout' => 'admin'
        ]);
    }

    public function update(Request $request, DetailSoal $detail)
    {
        $data = $request->all();

        $detail->update([
            'soal' => $data['soal']
        ]);

        $jwb = Jawaban::where('detail_soal_id', $detail->id)->get();

        for ($i = 0; $i < count($data['jawaban']); $i++) {
            $kunci = 0;

            if ($data['kunci'] == $i) {
                $kunci = 1;
            }

            $jwb[$i]->update([
                'jawaban' => $data['jawaban'][$i],
                'kunci' => $kunci
            ]);
        }

        return redirect(route('soal.show', $detail->soal_id))->with('berhasil', 'Detail soal berhasil diupdate');
    }

    public function destroy(DetailSoal $detail)
    {
        $jwb = Jawaban::where('detail_soal_id', $detail->id);
        $jwb->delete();
        if ($detail->gambar != null) {
            Storage::delete('public/' . $detail->gambar);
        }
        $detail->delete();

        return redirect(route('soal.show', $detail->soal_id))->with('berhasil', 'Detail soal berhasil dihapus');
    }

    public function excel(Request $request, $id)
    {
        $this->validate($request, [
            'excel' => 'file|mimes:xlsx|max:2048'
        ]);

        $data = $request->all();
        $data['excel'] = $request->file('excel')->store('soal/excel', 'public');

        $excel =  storage_path('app/public/' . $data['excel']);

        Excel::import(new SoalImport($id), $excel);
        Storage::delete('public/' . $excel);

        return redirect()->back()->with('berhasil', 'Detail soal berhasil diupload');
    }
}
