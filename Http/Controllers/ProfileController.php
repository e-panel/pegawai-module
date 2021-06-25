<?php

namespace Modules\Pegawai\Http\Controllers;

use Modules\Core\Http\Controllers\CoreController as Controller;
use Illuminate\Http\Request;

use Modules\Pegawai\Entities\Pimpinan\Riwayat as Pimpinan;
use Modules\Pegawai\Entities\Pimpinan\Pendidikan;
use Modules\Pegawai\Entities\Pimpinan\Karir;

class ProfileController extends Controller
{
    /**
     * Siapkan konstruktor controller
     * 
     * @param Role $data
     */
    public function __construct(Pimpinan $data, Pendidikan $pendidikan, Karir $karir) 
    {
        $this->data = $data;
        $this->pendidikan = $pendidikan;
        $this->karir = $karir;

        $this->prefix = 'epanel.pimpinan';
        $this->view = 'pegawai::pimpinan';

        view()->share([
            'view' => $this->view, 
            'prefix' => $this->prefix
        ]);
    }

    /**
     * Tampilkan halaman utama modul yang dipilih
     * 
     * @param Request $request
     * @return Response|View
     */
    public function index(Request $request, $uuid) 
    {
        $detail = $this->data->uuid($uuid)->firstOrFail();
        if(!$detail->pendidikan->count()):
            $this->pendidikan->create(['pimpinan_id' => $detail->id, 'label' => 'TK ...']);
            $this->pendidikan->create(['pimpinan_id' => $detail->id, 'label' => 'SD ...']);
            $this->pendidikan->create(['pimpinan_id' => $detail->id, 'label' => 'SMP ... (1967 - 1970)']);
            $this->pendidikan->create(['pimpinan_id' => $detail->id, 'label' => 'SMA ... (1970 - 1973)']);
            $this->pendidikan->create(['pimpinan_id' => $detail->id, 'label' => 'Universitas, Fakultas S1 (1979)']);
            $this->pendidikan->create(['pimpinan_id' => $detail->id, 'label' => 'Universitas, Fakultas, Jurusan S2 (1983)']);
        endif;

        return view("$this->view.profile", compact('detail'));
    }

    /**
     * Tampilkan halaman untuk menambah data
     * 
     * @return Response|View
     */
    public function create($uuid) 
    {
        return abort(404);
    }

    /**
     * Lakukan penyimpanan data ke database
     * 
     * @param Request $request
     * @return Response|View
     */
    public function store(Request $request, $uuid) 
    {
        $edit = $this->data->uuid($uuid)->firstOrFail();

        if($request->has('purpose')):
            if($request->purpose == 'karir'):
                $this->karir->wherePimpinanId($edit->id)->delete();
                foreach($request->periode as $i => $temp):
                    $this->karir->create([
                        'periode' => $temp, 
                        'label' => $request->label[$i], 
                        'pimpinan_id' => $edit->id
                    ]);
                endforeach;

                notify()->flash('Riwayat Karir berhasil diperbarui!', 'success');
            endif;

            if($request->purpose == 'pendidikan'):
                $this->pendidikan->wherePimpinanId($edit->id)->delete();
                foreach($request->pendidikan as $i => $temp):
                    $this->pendidikan->create([
                        'label' => $temp, 
                        'pimpinan_id' => $edit->id
                    ]);
                endforeach;

                notify()->flash('Riwayat Pendidikan berhasil diperbarui!', 'success');
            endif;

            if($request->purpose == 'overview'):
                $this->validate($request, ['sambutan' => 'required']);
                $edit->update(['sambutan' => $request->sambutan]);

                notify()->flash('Quote Pimpinan berhasil diperbarui!', 'success');
            endif;
        endif;

        return redirect()->back();
    }

    /**
     * Menampilkan detail lengkap
     * 
     * @param Int $id
     * @return Response|View
     */
    public function show($uuid, $id)
    {
        return abort(404);
    }

    /**
     * Tampilkan halaman perubahan data
     * 
     * @param Int $id
     * @return Response|View
     */
    public function edit(Request $request, $uuid, $id)
    {
        return abort(404);
    }

    /**
     * Lakukan perubahan data sesuai dengan data yang diedit
     * 
     * @param Request $request
     * @param Int $id
     * @return Response|View
     */
    public function update(PimpinanRequest $request, $uuid, $id)
    {
        return abort(404);
    }

    /**
     * Lakukan penghapusan data yang tidak diinginkan
     * 
     * @param Request $request
     * @param Int $id
     * @return Response|String
     */
    public function destroy(Request $request, $uuid, $id)
    {
        return abort(404);
    }
}
