@extends('layouts.default')

@section('css')
    <link rel="stylesheet" href="{{ asset('js/bootstrap-datepicker/css/datepicker.css') }}">
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Alterar Conteudo
        </div>
        <div class="card-body">
            {{ Form::open(array('method' => 'PUT', 'url' => route('contents.update', $content['id']))) }}
            <div class="form-group">
                {{ Form::label('Código') }}
                {{ Form::number('cod', $content['cod'], array('class' => 'form-control', 'required' => true)) }}
            </div>
            <div class="form-group">
                {{ Form::label('Nome') }}
                {{ Form::text('name', $content['name'], array('class' => 'form-control', 'required' => true)) }}
            </div>
            <div class="form-group">
                {{ Form::label('Data') }}
                {{ Form::text('date', !empty($content['date'])?\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $content['date'])->format('d/m/Y'):'', array('class' => 'form-control', 'required' => true)) }}
            </div>
            <div class="form-group">
                {{ Form::label('Custo') }}
                {{ Form::text('cost', App\Helpers\Helper::castFloatToReal($content['cost']), array('class' => 'form-control', 'required' => true)) }}
            </div>
            <div class="form-group text-right">
                {{ Form::submit('Alterar', array('class' => 'btn btn-success')) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/mask-money/jquery.maskMoney.min.js')}}"></script>

    <script>
        $('[name="date"]').datepicker({
            format: 'dd/mm/yyyy',
            locale: 'pt-BR',
            keyboardNavigation : false
        });

        $('[name="cost"]').maskMoney({
            prefix: "",
            decimal: ",",
            thousands: "."
        });
    </script>
@stop