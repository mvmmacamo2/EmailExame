@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="form-group">
                        <h3 class="text-danger"> Detalhes da Mensagem</h3>
                        <p class="text-success">{{ $email->corpo }}</p> 
                    </div>





                    <form method="POST" action="/email">


                     {!! csrf_field() !!}
                     <div class="form-group">
                        {{-- <label for="exampleInputEmail1">Email address</label> --}}
                        <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="to" value="{{ $email->from }}" readonly>
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>

                    <div class="form-group">
                        {{-- <label for="exampleInputPassword1">Assunto</label> --}}
                        <input type="hidden" class="form-control" id="exampleInputPassword1" placeholder="Assunto do seu Email" name="assunto" value="{{ $email->assunto }}" readonly>
                    </div>
                    <input type="hidden" name="estado" value="recebido">
                    <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">
                    <input type="hidden" name="from" value="{{ Auth()->user()->email }}">


                    <div class="form-group">
                        <label for="assunto">Responder</label>

                        <textarea name="corpo" cols="10" rows="4" id="corpo" class="form-control" placeholder="adicione o conteudo da sua Mensagem"></textarea>
                    </div>



                    <button type="submit" class="btn btn-primary">Responder</button>
                </form>








                {{-- FORM EDITAR --}}


                <form class="form-horizontal" method="POST" action="{{url('/email', $email->id)}}">


                  <input type="hidden" name="_method" value="PUT">

                  {!! csrf_field() !!}
                  <div class="form-group">
                    {{-- <label for="exampleInputEmail1">Email address</label> --}}
                    <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="to" value="{{ $email->to }}" readonly>
                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>

                <div class="form-group">
                    {{-- <label for="exampleInputPassword1">Assunto</label> --}}
                    <input type="hidden" class="form-control" id="exampleInputPassword1" placeholder="Assunto do seu Email" name="assunto" value="{{ $email->assunto }}" readonly>
                </div>
                {!! csrf_field() !!}
                <input type="hidden" name="estado" value="Lida">
                <input type="hidden" name="user_id" value="{{ $email->user_id }}">
                <input type="hidden" name="from" value="{{ $email->from }}">


                <div class="form-group">
                 {!! csrf_field() !!}
                 <input type="hidden" name="corpo" value="{{ $email->corpo }}">
             </div>



             <button type="submit" class="btn btn-warning">Voltar</button>


         </form>
     </div>
 </div>
</div>
</div>
</div>
@endsection
