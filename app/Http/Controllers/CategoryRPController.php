<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use App\audit;
use App\Respel;
use App\Permisos;
use App\Categoryrespelpublic;
use App\Subcategoryrespelpublic;
use Illuminate\Support\Arr;

class CategoryRPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(in_array(Auth::user()->UsRol, Permisos::RESPELPUBLIC) || in_array(Auth::user()->UsRol2, Permisos::RESPELPUBLIC)){
            $CategoriesRP = Categoryrespelpublic::with('SubCategoryRP')->get();
            // return $CategoriesRP;
            return view('categoryRP.index', compact('CategoriesRP'));
        }
        else{
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(in_array(Auth::user()->UsRol, Permisos::RESPELPUBLIC) || in_array(Auth::user()->UsRol2, Permisos::RESPELPUBLIC)){
            
            return view('categoryRP.create');
        }
        else{
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'CategoryRpName'       => 'required|min:5|max:128',
        ]);
        $categoria = new Categoryrespelpublic();
        $categoria->CategoryRpName = $request->input('CategoryRpName');
        $categoria->save();

        return redirect()->route('categorypublic.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(in_array(Auth::user()->UsRol, Permisos::RESPELPUBLIC) || in_array(Auth::user()->UsRol2, Permisos::RESPELPUBLIC)){
            $categoria = Categoryrespelpublic::with('SubCategoryRP')
            ->where('ID_CategoryRP', $id)
            ->first();
            if (!$categoria) {
                abort(404);
            }
            $Subcategorias = Subcategoryrespelpublic::where('FK_CategoryRP', $id)->count();

            return view('categoryRP.edit', compact('categoria', 'Subcategorias'));
        }
        else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'CategoryRpName'       => 'required|min:5|max:128',
        ]);
        $categoria = Categoryrespelpublic::find($id);
        $categoria->CategoryRpName = $request->input('CategoryRpName');
        $categoria->save();

        $log = new audit();
        $log->AuditTabla="categoryrespelpublic";
        $log->AuditType="Actualizado";
        $log->AuditRegistro=$Subcategory->ID_CategoryRP ;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request->input('CategoryRpName');
        $log->save();

        return redirect()->route('categorypublic.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categoryrespelpublic::destroy($id);

        $log = new audit();
        $log->AuditTabla="categoryrespelpublic";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$id ;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog='registro con id '.$id.' eliminado';
        $log->save();

        return redirect()->route('categorypublic.index');
    }
}
