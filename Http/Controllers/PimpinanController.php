<?php

namespace Modules\Pegawai\Http\Controllers;

use Modules\Core\Http\Controllers\CoreController as Controller;
use Illuminate\Http\Request;

use Modules\Pegawai\Entities\Pimpinan\Riwayat as Pimpinan;
use Modules\Pegawai\Http\Requests\PimpinanRequest;

class PimpinanController extends Controller
{
    protected $title;

    /**
     * Siapkan konstruktor controller
     * 
     * @param Role $data
     */
    public function __construct(Pimpinan $data) 
    {
        $this->title = __('pegawai::general.pimpinan.title');
        $this->data = $data;

        $this->toIndex = route('epanel.pimpinan.index');
        $this->prefix = 'epanel.pimpinan';
        $this->view = 'pegawai::pimpinan';

        $this->tCreate = __('core::general.created', ['attribute' => strtolower($this->title)]);
        $this->tUpdate = __('core::general.updated', ['attribute' => strtolower($this->title)]);
        $this->tDelete = __('core::general.deleted', ['attribute' => strtolower($this->title)]);

        view()->share([
            'title' => $this->title, 
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
    public function index(Request $request) 
    {
        $data = $this->data->latest()->get();

        if($request->has('datatable')):
            return $this->datatable($data);
        endif;

        return view("$this->view.index", compact('data'));
    }

    /**
     * Tampilkan halaman untuk menambah data
     * 
     * @return Response|View
     */
    public function create() 
    {
        return view("$this->view.create");
    }

    /**
     * Lakukan penyimpanan data ke database
     * 
     * @param Request $request
     * @return Response|View
     */
    public function store(PimpinanRequest $request) 
    {
        $input = $request->all();

        if($request->filled('aktif')):
            $input['aktif'] = 1;
            $this->data->query()->update(['aktif' => 0]);
        else:
            $input['aktif'] = 0;
        endif;
        
        if($request->hasFile('foto')):
            $input['foto'] = $this->upload($request->file('foto'), uuid());
        else:
            $input['foto'] = null;
        endif;

        $this->data->create($input);

        notify()->flash($this->tCreate, 'success');
        return redirect($this->toIndex);
    }

    /**
     * Menampilkan detail lengkap
     * 
     * @param Int $id
     * @return Response|View
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Tampilkan halaman perubahan data
     * 
     * @param Int $id
     * @return Response|View
     */
    public function edit(Request $request, $id)
    {
        $edit = $this->data->uuid($id)->firstOrFail();

        if($request->has('aktif')):
            $this->data->query()->update(['aktif' => 0]);

            $edit->update(['aktif' => $edit->aktif == 0 ? 1 : 0]);
            notify()->flash(__('core::general.changed'), 'success');
            return redirect()->back();
        endif;

        return view("$this->view.edit", compact('edit'));
    }

    /**
     * Lakukan perubahan data sesuai dengan data yang diedit
     * 
     * @param Request $request
     * @param Int $id
     * @return Response|View
     */
    public function update(PimpinanRequest $request, $id)
    {    
        $edit = $this->data->uuid($id)->firstOrFail();

        $input = $request->all();

        if($request->filled('aktif')):
            $input['aktif'] = 1;
            $this->data->query()->update(['aktif' => 0]);
        else:
            $input['aktif'] = 0;
        endif;

        if($request->hasFile('foto')):
            deleteImg($edit->foto);
            $input['foto'] = $this->upload($request->file('foto'), $edit->uuid);
        else:
            $input['foto'] = $edit->foto;
        endif;

        $edit->update($input);

        notify()->flash($this->tUpdate, 'success');
        return redirect($this->toIndex);
    }

    /**
     * Lakukan penghapusan data yang tidak diinginkan
     * 
     * @param Request $request
     * @param Int $id
     * @return Response|String
     */
    public function destroy(Request $request, $id)
    {
        if($request->has('pilihan')):
            foreach($request->pilihan as $temp):
                $each = $this->data->uuid($temp)->firstOrFail();
                deleteImg($each->foto);
                $each->delete();
            endforeach;

            notify()->flash($this->tDelete, 'success');
            return redirect()->back();
        endif;
    }

    /**
     * Function for Upload File
     * 
     * @param  $file, $filename
     * @return URI
     */
    public function upload($file, $filename) 
    {
        $tmpFilePath = 'app/public/Pimpinan/';
        $tmpFileDate =  date('Y-m') .'/'.date('d').'/';
        $tmpFileName = $filename;
        $tmpFileExt = $file->getClientOriginalExtension();

        makeImgDirectory($tmpFilePath . $tmpFileDate);
        
        $nama_file = $tmpFilePath . $tmpFileDate . $tmpFileName;
        
        \Image::make($file->getRealPath())->resize(500, null, function($constraint) {
            $constraint->aspectRatio();
        })->save(storage_path() . "/$nama_file.$tmpFileExt");
        
        \Image::make($file->getRealPath())->fit(150, 150)->save(storage_path() . "/{$nama_file}_m.$tmpFileExt");

        return "storage/Pimpinan/{$tmpFileDate}{$tmpFileName}.{$tmpFileExt}";
    } 

    /**
     * Datatable API
     * 
     * @param  $data
     * @return Datatable
     */
    public function datatable($data) 
    {
        return datatables()->of($data)
            ->editColumn('pilihan', function($data) {
                $return  = '<span>';
                $return .= '    <div class="checkbox checkbox-only">';
                $return .= '        <input type="checkbox" id="pilihan['.$data->id.']" name="pilihan[]" value="'.$data->uuid.'">';
                $return .= '        <label for="pilihan['.$data->id.']"></label>';
                $return .= '    </div>';
                $return .= '</span>';
                return $return;
            })
            ->editColumn('foto', function($data) {
                if(is_null($data->foto)):
                    return '<img src="'. \Avatar::create($data->nama)->toBase64() .'" >';
                else:
                    return '<img src="'. viewImg($data->foto, 'm') .'" >';
                endif;
            })
            ->editColumn('nama', function($data) {
                $return  = $data->nama;
                $return .= '<div class="font-11 color-blue-grey-lighter">'.$data->periode.'</div>';
                return $return;
            })
            ->editColumn('mulai_jabatan', function($data) {
                $return  = '<div class="font-11 color-blue-grey-lighter uppercase">Mulai Jabatan</div>';
                $return .= $data->mulai_jabatan;
                return $return;
            })
            ->editColumn('akhir_jabatan', function($data) {
                $return  = '<div class="font-11 color-blue-grey-lighter uppercase">Akhir Jabatan</div>';
                $return .= $data->akhir_jabatan;
                return $return;
            })
            ->editColumn('aktif', function($data) {
                $return  = '<div class="btn-toolbar">';
                if($data->aktif == 1):
                    $return .= '    <div class="btn-group btn-group-sm">';
                    $return .= '        <a href="'. route("$this->prefix.edit", $data->uuid) .'?aktif=true" class="btn btn-sm btn-success">';
                    $return .= '            <span class="fa fa-check"></span>';
                    $return .= '        </a>';
                    $return .= '    </div>';
                    $return .= '</div>';
                else:
                    $return .= '    <div class="btn-group btn-group-sm">';
                    $return .= '        <a href="'. route("$this->prefix.edit", $data->uuid) .'?aktif=true" class="btn btn-sm btn-danger">';
                    $return .= '            <span class="fa fa-times"></span>';
                    $return .= '        </a>';
                    $return .= '    </div>';
                    $return .= '</div>';
                endif;
                return $return;
            })
            ->editColumn('tanggal', function($data) {
                \Carbon\Carbon::setLocale('id');
                $return  = '<small>' . date('Y-m-d h:i:s', strtotime($data->created_at)) . '</small><br/>';
                $return .= str_replace('yang ', '', $data->created_at->diffForHumans());
                return $return;
            })
            ->editColumn('aksi', function($data) {
                $return  = '<div class="btn-toolbar">';
                $return .= '    <div class="btn-group btn-group-sm">';
                $return .= '        <a href="'. route("$this->prefix.edit", $data->uuid) .'" class="btn btn-primary-outline">';
                $return .= '            <span class="fa fa-pencil"></span>';
                $return .= '        </a>';
                if($data->aktif == 1):
                    $return .= '        <a href="'. route("$this->prefix.profile.index", $data->uuid) .'" class="btn btn-success-outline">';
                    $return .= '            <span class="fa fa-user"></span> Profile';
                    $return .= '        </a>';
                endif;
                $return .= '    </div>';
                $return .= '</div>';
                return $return;
            })
            ->rawColumns(['pilihan', 'foto', 'nama', 'mulai_jabatan', 'akhir_jabatan', 'aktif', 'tanggal', 'aksi'])->toJson();
    }
}
