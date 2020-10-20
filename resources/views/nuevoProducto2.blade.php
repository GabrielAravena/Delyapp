@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Nuevo producto</div>

                <div class="card-body">
                    <div>
                      

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-md-left">Nombre del producto</label>
                            <label class="col-md-2 col-form-label text-md-left"><strong>{{ $producto->nombre }}</strong></label>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card justify-content-center">
                                    <table class="table table-sm">
                                            <thead>
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Unidad de medida</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                        @foreach($ingredientes as $ingrediente)
                                                <tr>
                                                <td>{{$ingrediente->nombre}}</td>
                                                <td>{{$ingrediente->cantidad}}</td>
                                                <td>{{$ingrediente->unidad_medida}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>         
                                    </div>
                                </div>
                            </div>     
                        </div>

                    <form method="POST" action="{{ route('menu.store2'), $precioSugerido }}">
                        @csrf   
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-md-left">Tiempo de preparación</label>
                            <input id="cantidad_en_inventario" max="99999999" type="number" class="col-md-2 form-control text-md-left" name="tiempo_preparacion" required>
                            <label class="col-md-2 col-form-label text-md-left">minutos</label>
                       
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-md-left">Descripción del producto</label>
                            <textarea type="textarea" maxlength="225" class="col-md-8 form-control text-md-left" name="descripcion" required></textarea>
                        </div>

                        <div class="form-group row offset-md-2">
                            <label class="col-md-2">Precio sugerido</label>
                            <label class="col-md-4 "><strong>$ {{ $precioSugerido }}</strong></label>
                        </div>
                        
                        <div class="form-group row offset-md-2">
                            <label class="col-md-3">
                                <input id="sugerido" name="radio" type="radio" value="sugerido" onclick="ocultar();" checked/>
                                <span>Utilizar precio sugerido</span>
                            </label>
                        </div>
                        <div class="form-group row offset-md-2">
                            <label class="col-md-3">
                                <input id="otro" name="radio" type="radio" value="otro" onclick="mostrar();"/>
                                <span>Utilizar otro precio</span>
                            </label>
                            <input id="precio" max="99999999" type="number" class="col-md-2 form-control text-md-left" name="precio" style="display:none" />
                            <input id="precioSugerido" type="number" class="col-md-2 form-control text-md-left" name="precioSugerido" value="{{ $precioSugerido }}" style="display:none" />
                        </div>
                    
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
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

<script>


    function mostrar(){
        document.getElementById('precio').style.display = 'block';
        $('#precio').prop("required", true);
    }

    function ocultar(){
        document.getElementById('precio').style.display = 'none';
        $('#precio').removeAttr("required");
    }

</script>

@endsection