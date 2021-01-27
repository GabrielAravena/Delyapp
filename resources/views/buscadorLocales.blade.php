<div class="container-wide mt-5">
    <div class="row justify-content-xs-center mt-5 mb-5">
        @foreach($locales as $local)
        <div class="col-sm-6 col-md-4 view-animate zoomInSmall delay-04 active mt-5 text-center">
            <a class="thumbnail-variant-3" href="{{ route('local.index', $local['id']) }}">
                <img type="button" src="{{ asset($local['imagen']) }}" width="300px" height="250px">
            </a>
            <h4>{{ $local['nombre'] }}</h4>
            <p class="mb-0 text-left" style="margin-left: 40px;">{{ $local['direccion'] }}</p>
            <a class="float-left" style="margin-left: 40px;" href="tel: {{ $local['telefono'] }}">{{ $local['telefono'] }}</a>
        </div>
        @endforeach
    </div>
</div>