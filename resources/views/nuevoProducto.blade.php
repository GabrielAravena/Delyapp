@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Nuevo producto</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('menu.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nombre_ingrediente" class="col-md-2 col-form-label text-md-left">Nombre del producto</label>
                            <input id="nombre_ingrediente" maxlength="225" type="text" class="col-md-4 form-control text-md-left" name="nombre" value=""  required>
  
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
            
                                    <div class="card">

                                        <table id="tablaNuevoProducto" class="table table-md">
                                            <tbody>

                                                <tr>
                                                    <div class="form-group row">
                                                        <td>
                                                            <label class="col-md-12 col-form-label text-md-left">Ingrediente</label>
                                                        </td>
                                                        <td>
                                                            <select id="ingrediente1" type="text" class="form-control" name="ingrediente1" value="" >
                                                                @foreach($inventarios as $inventario)
                                                                <option value="{{$inventario->nombre}}">{{$inventario->nombre}}</option> 
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <label class="col-md-12 col-form-label text-md-left">Cantidad</label>
                                                        </td>
                                                        <td>
                                                            <input id="cantidad1" max="999999" type="number" class="col-md-12 form-control text-md-left" name="cantidad1" required>
                                                        </td>
                                                        <td>
                                                            <label class="col-md-12 col-form-label text-md-left">Unidad de medida</label>
                                                        </td>
                                                        <td>
                                                            <select id="unidad_medida1" type="text" class="form-control" name="unidad_medida1" value="" >
                                                                <option value="Kilogramo">Kilogramo</option>
                                                                <option value="Gramo" selected>Gramo</option>
                                                                <option value="Litro" >Litro</option>
                                                                <option value="Ml">Ml</option>
                                                                <option value="Unidad">Unidad</option>
                                                            </select>
                                                        </td>
                                                    </div>
                                                </tr>
                                            </tbody>
                                        </table>    
                                        <button type="button" id="btnAgregarIngrediente" class="col-sm-1 btn btn-primary">+</button>                  
                                    </div>
                                </div>
                            </div>     
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" id="confirmarIngredientes" type="submit" class="col-md-4 btn btn-success justify-center">Confirmar ingredientes</button>  
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

<script>

    /* Agrega una fila a la tabla para agregar ingredientes */
$(document).ready(function(){
    var c = 1;
    $('#btnAgregarIngrediente').click(function(){
        c++;
        $('#tablaNuevoProducto').append(
            '<tr>'+
            '<div class="form-group row" id="'+c+'">'+
                '<td>'+
                    '<label class="col-md-12 col-form-label text-md-left">Ingrediente</label>'+
                '</td>'+
                '<td>'+
                    '<select id="ingrediente1" type="text" class="form-control" name="ingrediente'+c+'" value="" >'+
                        '@foreach($inventarios as $inventario)'+
                        '<option value="{{$inventario->nombre}}">{{$inventario->nombre}}</option>'+
                        '@endforeach'+
                    '</select>'+
                '</td>'+
                '<td>'+
                    '<label class="col-md-12 col-form-label text-md-left">Cantidad</label>'+
                '</td>'+
                '<td>'+
                    '<input id="cantidad'+c+'" max="999999" type="number" class="col-md-12 form-control text-md-left" name="cantidad'+c+'" required>'+
                '</td>'+
                '<td>'+
                    '<label class="col-md-12 col-form-label text-md-left">Unidad de medida</label>'+
                '</td>'+
                '<td>'+
                    '<select id="unidad_medida'+c+'" type="text" class="form-control" name="unidad_medida'+c+'" value="" >'+
                        '<option value="Kilogramo">Kilogramo</option>'+
                        '<option value="Gramo" selected>Gramo</option>'+
                        '<option value="Litro" >Litro</option>'+
                        '<option value="Ml">Ml</option>'+
                        '<option value="Unidad">Unidad</option>'+
                    '</select>'+
                '</td>'+
            '</div>'+
        '</tr>'
        );
    });
});         
</script>
@endsection