@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <form action="{{ route('post.store') }}" method="post" class="">
                        @csrf
                        <div class="form-group">
                            <label for="title">Titulo</label>

                            <input type="text" name="title" id="title" class="form-control">

                        </div>
                        <div class="form-group">

                            <label for="content">Contenido</label>
                            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                            
                        </div>

                        
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
