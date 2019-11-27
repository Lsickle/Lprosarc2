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

class SubCategoryRPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(in_array(Auth::user()->UsRol, Permisos::RESPELPUBLIC) || in_array(Auth::user()->UsRol2, Permisos::RESPELPUBLIC)){
            // $SubCategoriesRP = Subcategoryrespelpublic::all();
            $SubCategoriesRP = DB::table('subcategoryrespelpublic')
                ->join('categoryrespelpublic', 'categoryrespelpublic.ID_CategoryRP', '=', 'subcategoryrespelpublic.FK_CategoryRP')
                ->select('subcategoryrespelpublic.*', 'categoryrespelpublic.*')
                ->get();
            // return $SubCategoriesRP;
            return view('subcategoryRP.index', compact('SubCategoriesRP'));
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
        $categories = Categoryrespelpublic::All();

        return view('subcategoryRP.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        for ($x=0; $x < count($request['SubCategoryRpName']); $x++) {
            $Subcategory = new Subcategoryrespelpublic();
            $Subcategory->SubCategoryRpName = $request['SubCategoryRpName'][$x];
            $Subcategory->FK_CategoryRP = $request['categorias'];
            $Subcategory->save();

            $log = new audit();
            $log->AuditTabla="subcategoryrespelpublic";
            $log->AuditType="Creado";
            $log->AuditRegistro=$Subcategory->ID_SubCategoryRP ;
            $log->AuditUser=Auth::user()->email;
            $log->Auditlog=$request['SubCategoryRpName'][$x];
            $log->save();
        }  
        return redirect()->route('subcategorypublic.index');

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
        $Borrar = Respel::where('FK_SubCategoryRP', $id)->first();
        $Subcategoria = Subcategoryrespelpublic::find($id); 
        if (!$Subcategoria) {
            abort(404, 'la SubCategoria no existe en la Base de Datos');
        }
        $categories = Categoryrespelpublic::All();
        //return $Borrar;
        return view('subcategoryRP.edit', compact('Subcategoria', 'categories','Borrar'));   
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
        $Subcategory = Subcategoryrespelpublic::find($id);
        $Subcategory->SubCategoryRpName = $request['SubCategoryRpName'];
        $Subcategory->FK_CategoryRP = $request['categorias'];
        $Subcategory->save();

        $log = new audit();
        $log->AuditTabla="subcategoryrespelpublic";
        $log->AuditType="Actualizado";
        $log->AuditRegistro=$Subcategory->ID_SubCategoryRP ;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=$request['SubCategoryRpName'];
        $log->save();

        return redirect()->route('subcategorypublic.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subcategoryrespelpublic::destroy($id);

        $log = new audit();
        $log->AuditTabla="subcategoryrespelpublic";
        $log->AuditType="Eliminado";
        $log->AuditRegistro=$id ;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog='registro con id '.$id.' eliminado';
        $log->save();

        return redirect()->route('subcategorypublic.index');
    }
}
