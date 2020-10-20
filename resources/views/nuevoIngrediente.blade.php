@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nuevo ingrediente</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('inventario.store')}}">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Nombre ingrediente</label>

                            <div class="col-md-6">
                                <input id="nombre_ingrediente" type="text" class="form-control" name="nombre" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unidad_medida" class="col-md-4 col-form-label text-md-right">Unidad de medida</label>

                            <div class="col-md-6">
                                <select id="unidad_medida" class="form-control" name="unidad_medida" onchange="showSelected();">
                                    <option value="Kilogramo">Kilogramo</option> 
                                    <option value="Gramo" selected>Gramo</option>
                                    <option value="Litro">Litro</option>
                                    <option value="Ml">Ml</option>
                                    <option value="Unidad">Unidad</option>
                                </select>
                            </div>
                        </div>
                     
                        <div class="form-group row">
                            <label for="cantidad_en_inventario" class="col-md-4 col-form-label text-md-right">Cantidad en inventario</label>

                            <div class="col-md-6">
                                <input id="cantidad_en_inventario" type="number" class="form-control " name="cantidad" required>
                            </div>
                        </div>

                        <div class="form-group row">
                         
                            <label class="col-md-3 col-form-label text-md-right">Precio por cada</label>
                            <label id="precio_por_cada" class="col-form-label text-md-left">Gramo</label>
                        
                            <div class="col-md-6">
                                <input id="precio" type="number" class="form-control" name="precio" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function showSelected(){
        var cod = document.getElementById("unidad_medida").value;
        document.getElementById('precio_por_cada').innerHTML= cod;
    }
</script>
@endsection