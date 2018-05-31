<!doctype html>

<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12">

            <div class="card">
                <div class="card-header">
                    Cadastrar
                </div>
                <div class="card-body">
                    {{ Form::open(array('method' => 'POST', 'url' => route('users.store'))) }}
                    <div class="form-group">
                        {{ Form::label('E-mail') }}
                        {{ Form::email('email', null, array('class' => 'form-control', 'required' => true)) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Senha') }}
                        {{ Form::password('password', array('class' => 'form-control', 'required' => true)) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Confirmação de Senha') }}
                        {{ Form::password('password_confirmation', array('class' => 'form-control', 'required' => true)) }}
                    </div>
                    <div class="form-group text-right">
                        {{ Form::submit('Alterar', array('class' => 'btn btn-success')) }}
                    </div>
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alert alert-{{ $msg }}">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {!! Session::get('alert-' . $msg) !!}
                                </p>
                            @endif
                        @endforeach
                    </div>
                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
</html>