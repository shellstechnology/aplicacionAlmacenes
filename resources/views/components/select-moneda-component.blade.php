@php
$datos = session('monedas', []);
@endphp

@if (!empty($datos))
    <select id="tipoMoneda"  name="tipoMoneda">
        @foreach ($datos as $monedas)
            <option value="{{$monedas['moneda']}}">{{ $monedas['moneda']}}</option>
        @endforeach
    </select>
    <label for="tipoMoneda">Moneda</label>
@endif
