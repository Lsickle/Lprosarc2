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
                    <form role="form" action="/subcategorypublic/{{$Subcategoria->ID_SubCategoryRP}}" method="POST" enctype="multipart/form-data" id="myForm">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-danger pull-right"> <i class="fa fa-trash"></i> Eliminar </button>
                    </form>
                    </div>
                </div>
                <form role="form" action="/subcategorypublic/{{$Subcategoria->ID_SubCategoryRP}}" method="POST" enctype="multipart/form-data" id="myForm">
                @method('PUT')
                @csrf
                <div class="box-body">
                    <div class="col-md-6">
                        <label> Categorías </label>
                        <div>
                            <select name="categorias" required>
                                <option style="white-space: nowrap;">Seleccione las categorías...</option>
                                @foreach($categories as $categoria)
                                @if($categoria->ID_CategoryRP == $Subcategoria->FK_CategoryRP)
                                <option selected value="{{$categoria->ID_CategoryRP}}">{{$categoria->CategoryRpName}}</option>
                                @else
                                <option value="{{$categoria->ID_CategoryRP}}">{{$categoria->CategoryRpName}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div><br>
                    </div>

                    <div class="col-md-6">
                        <label>SubCategoría </label>
                        <div class="input-group">
                            <input maxlength="60" class="form-control" type="text" name="SubCategoryRpName" value="{{$Subcategoria->SubCategoryRpName}}">
                             <a class="input-group-addon" style=" color: grey;" data-toggle="popover" title="<b>Nombre de la SubCategoría</b>" data-content="escriba el nombre que desea asignar a la SubCategoría... máximo 60 caracteres" data-html="true" data-trigger="hover"><i class="fas fa-object-ungroup"></i></a>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success" style="margin-left: 1.5rem;"><i class="fas fa-check"></i> Actualizar</button>

                    <a class="btn btn-default btn-close pull-right" style="margin-right: 1.7rem;" href="{{ URL::previous() }}"><i class="fas fa-backspace" color="red"></i> {{ trans('adminlte_lang::LangTratamiento.cancel') }}</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection