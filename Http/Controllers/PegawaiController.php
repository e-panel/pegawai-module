<?php

namespace Modules\Pegawai\Http\Controllers;

use Modules\Core\Http\Controllers\CoreController as Controller;
use Illuminate\Http\Request;

use Modules\Pegawai\Entities\Satker;
use Modules\Pegawai\Entities\Personil as Pegawai;
use Modules\Pegawai\Http\Requests\PersonilRequest;

class PegawaiController extends Controller
{
    protected $title;

    /**
     * Siapkan konstruktor controller
     * 
     * @param Role $data
     */
    public function __construct(Pegawai $data, Satker $satker) 
    {
        $this->title = __('pegawai::general.personil.title');
        $this->data = $data;
        $this->satker = $satker;

        $this->toIndex = route('epanel.pegawai.index');
        $this->prefix = 'epanel.pegawai';
        $this->view = 'pegawai::pegawai';

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
        if($request->has('import')):
            if(!$this->data->count()):
                foreach($this->satker->latest()->get() as $temp):
                    $this->data->create([
                        'nama' => '-', 
                        'nip' => '-', 
                        'golongan' => '-', 
                        'id_bidang' => $temp->id
                    ]);
                endforeach;
                return redirect()->back();
            endif;
        endif;

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
    public function store(PersonilRequest $request) 
    {
        $input = $request->all();

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

        return view("$this->view.edit", compact('edit'));
    }

    /**
     * Lakukan perubahan data sesuai dengan data yang diedit
     * 
     * @param Request $request
     * @param Int $id
     * @return Response|View
     */
    public function update(PersonilRequest $request, $id)
    {    
        $edit = $this->data->uuid($id)->firstOrFail();

        $input = $request->all();

        if($request->hasFile('foto')):
            if(!is_null($edit->foto)):
                deleteImg($edit->foto);
            endif;
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
        $tmpFilePath = 'app/public/Personil/';
        $tmpFileDate =  date('Y-m') .'/'.date('d').'/';
        $tmpFileName = $filename;
        $tmpFileExt = $file->getClientOriginalExtension();

        makeImgDirectory($tmpFilePath . $tmpFileDate);
        
        $nama_file = $tmpFilePath . $tmpFileDate . $tmpFileName;
        
        \Image::make($file->getRealPath())->resize(500, null, function($constraint) {
            $constraint->aspectRatio();
        })->save(storage_path() . "/$nama_file.$tmpFileExt");
        
        \Image::make($file->getRealPath())->fit(100, 100)->save(storage_path() . "/{$nama_file}_m.$tmpFileExt");

        return "storage/Personil/{$tmpFileDate}{$tmpFileName}.{$tmpFileExt}";
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
            ->editColumn('name', function($data) {
                return $data->nama;
            })
            ->editColumn('phone', function($data) {
                return $data->telepon;
            })
            ->editColumn('email', function($data) {
                return $data->email;
            })
            ->editColumn('golongan', function($data) {
                return $data->golongan;
            })
            ->editColumn('field', function($data) {
                return optional($data->bidang)->jabatan;
            })
            ->editColumn('aksi', function($data) {
                $return  = '<div class="btn-toolbar">';
                $return .= '    <div class="btn-group btn-group-sm">';
                $return .= '        <a href="'. route("$this->prefix.edit", $data->uuid) .'" class="btn btn-primary-outline">';
                $return .= '            <span class="fa fa-pencil"></span>';
                $return .= '        </a>';
                $return .= '    </div>';
                $return .= '</div>';
                return $return;
            })
            ->rawColumns(['pilihan', 'name', 'phone', 'email', 'golongan', 'field', 'aksi'])->toJson();
    }
}
