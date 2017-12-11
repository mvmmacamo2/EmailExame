@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard  <a href="/email" class="btn btn-default">Home</a></div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="/email">
                     {!! csrf_field() !!}
                     <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="to">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Assunto</label>
                        <input type="texte" class="form-control" id="exampleInputPassword1" placeholder="Assunto do seu Email" name="assunto">
                    </div>
                    <input type="hidden" name="estado" value="recebido">
                    <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">
                    <input type="hidden" name="from" value="{{ Auth()->user()->email }}">


                    <div class="form-group">
                        <label for="assunto">Corpo</label>

                        <textarea name="corpo" cols="10" rows="4" id="corpo" class="form-control" placeholder="adicione o conteudo da sua Mensagem"></textarea>
                    </div>



                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
