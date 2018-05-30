@extends('layouts.default')

@section('content')
    <div class="card">
        <div class="card-header">
            Alterar Senha
        </div>
        <div class="card-body">
            {{ Form::open(array('method' => 'PUT', 'url' => route('users.update', $user['id']))) }}
            <div class="form-group">
                {{ Form::label('E-mail') }}
                {{ Form::email('email', $user['email'], array('class' => 'form-control', 'disabled' => true)) }}
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
            {{ Form::close() }}
        </div>
    </div>
@stop