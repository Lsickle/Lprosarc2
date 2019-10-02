@extends('layouts.app')
@section('htmlheader_title')
Subcategorías
@endsection
@section('contentheader_title')

@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">crear SubCategoría</h3>
                    <div class="box-tools pull-right">
                     <button onclick="AgregarSubCat()" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> Agregar SubCategoria</button>
                    </div>
                </div>
                <form role="form" action="/subcategorypublic" method="POST" enctype="multipart/form-data" id="myForm">
                @csrf
                <div class="box-body" id="categoriapanel">
                    <div class="col-md-12" id="categoria">
                        <label for="input[]"> Categorías </label>
                        <div>
                            <select name="categorias" required>
                                <option disabled selected style="white-space: nowrap;">Seleccione las categorías...</option>
                                @foreach($categories as $categoria)
                                <option value="{{$categoria->ID_CategoryRP}}">{{$categoria->CategoryRpName}}</option>
                                @endforeach
                            </select>
                        </div><br>
                    </div>

                    <div class="col-md-6" id="subcategoria0">
                        <label for="subcategorianame[]">SubCategoría </label>
                        <div class="input-group">
                            <input maxlength="60" id="subcategorianame[]" class="form-control" type="text" name="SubCategoryRpName[]">
                             <a class="input-group-addon" style=" color: grey;" data-toggle="popover" title="Eliminar SubCategoría" data-content="Debe crear al menos una SubCategoria, asi que este campo no lo puede eliminar" data-html="true" data-trigger="hover"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success" style="margin-left: 1.5rem;"><i class="fas fa-check"></i> {{ trans('adminlte_lang::LangTratamiento.pretratcreate') }}</button>

                    <a class="btn btn-default btn-close pull-right" style="margin-right: 1.7rem;" href="{{ URL::previous() }}"><i class="fas fa-backspace" color="red"></i> {{ trans('adminlte_lang::LangTratamiento.cancel') }}</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('NewScript')
<script>
    var contador = 1;
    function AgregarSubCat(){
        var subcategoria = '<div class="col-md-6" id="subcategoria'+contador+'"><label for="subcategorianame[]">SubCategoría </label><div class="input-group"><input maxlength="60" id="subcategorianame[]" class="form-control" type="text" name="SubCategoryRpName[]"><a onclick="EliminarSubCat('+contador+')" class="input-group-addon" style=" color: red;" data-toggle="popover" title="Eliminar SubCategoría" data-content="haga click para eliminar la SubCategoria y luego envie el formulario" data-html="true" data-trigger="hover"><i class="fas fa-trash"></i></a></div></div>';
        $("#categoriapanel").append(subcategoria);
        $("#myForm").validator('update');
        contador= parseInt(contador)+1;
        popover();
    }
    function EliminarSubCat(id){
        $("#subcategoria"+id).remove();
        $("#myForm").validator('update');
    }
    popover();
</script>
@endsection