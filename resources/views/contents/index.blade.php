@extends('layouts.default')

@section('css')
    <link rel="stylesheet" href="{{ asset('js/datatables/datatables.css') }}">
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Contatos
        </div>
        <div class="card-body">

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Data</th>
                    <th>Custo</th>
                    <th>Telefone</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($contents as $content)
                    <tr>
                        <td>{{ $content['id'] }}</td>
                        <td>{{ $content['cod'] }}</td>
                        <td>{{ $content['name'] }}</td>
                        <td>{{ !empty($content['date'])?\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $content['date'])->format('d/m/Y'):'' }}</td>
                        <td>{{ App\Helpers\Helper::castFloatToReal($content['cost']) }}</td>
                        <td>{{ $content['phone'] }}</td>
                        <td class="text-center">
                            <a href="{{ route('contents.edit', ['id' => $content['id']]) }}" class="btn btn-primary btn-sm" onclick="">Editar</a>
                            <a href="#" class="btn btn-danger btn-sm" onclick="if(confirm('Tem certeza que deseja excluir?')){ removeContent({{$content['id']}}, this); }">Excluir</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/datatables/datatables.js') }}"></script>
    <script src="{{ asset('js/pages/contents.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                }
            });
        } );
    </script>
@stop