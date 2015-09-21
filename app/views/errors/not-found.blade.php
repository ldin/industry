@extends('home.layout')

@section('title')
Страница не найдена
@stop

@section('content')
<div class="container">

    @if (Session::has('status'))
        <div class="alert alert-success">
            {{ Session::get('status') }}
        </div>
    @elseif (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="row row-block block-404 txt1">
        <div class="col-xs-12">
            <p class="left e404 error404"> ! </p>
            <p class="left error404"> 404 <br /> Страница не найдена</p>
        </div>    
            <br /><br />
        <div class="col-xs-12">    
            <p>Возможно вы пробуете загрузить несуществующую или удаленную страницу. <br/>
            Попробуйте навигацию вверху или перейдите <a href="/">на главную</a> страницу.</p>
        </div>
    </div>    

</div>
@stop
