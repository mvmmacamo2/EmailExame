@extends('layouts.app')

@section('content')
<div class="container">


    {{-- col-md-offset-2 --}}

    <div class="panel panel-default">
        <div class="panel-heading">

         <p><strong class="text-success"> {{ $nremail }} </strong> emails Recebidos</p>
    {{--        <pre>


    </pre> --}}
</div>

<div class="panel-body">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="row">


        <div class="col-md-2">
            <div class="panel-default">
                <div class="panel-body">
                    <div class="panel-heading">
                        Opercaoes
                    </div>

                    <div class="form-group">
                        <a class="btn btn-success btn-sm" href="/email/create">Enviar Email</a>
                    </div>

                    <div class="form-group">
                        <a class="btn btn-info btn-sm" href="/emails/enviados">Emails Enviados</a>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-10 ">
            <table class="table table-bordered table-hover table-responsive">
               <caption>Inbox</caption>
               <thead>
                 <tr>
                    <th>from</th>
                    <th>Assunto</th>
                    <th>Mensagem</th>
                    <th>Estado</th>
                    <th>Recido Em</th>
                    <th>Operacoes</th>

                </tr>
            </thead>
            <tbody>
              @foreach($emails as $m)
              <tr>


                <td>{{ $m->from}}</td>
                <td>{{ $m->assunto}}</td>
                <td>{{ $m->corpo}}</td>
                <td>{{ $m->estado}}</td>
                <td>{{ $m->created_at }}</td>
                <td> <a href="{{ route('email.edit', $m->id) }}" class="btn btn-primary">ler</a></td>

            </tr>
            @endforeach
        </tbody>
    </table>







</div>

</div>
</div>
</div>
</div>
@endsection
