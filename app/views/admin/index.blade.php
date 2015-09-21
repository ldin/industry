@extends('admin.layout')
@section('content')

<div class="main-page">
    <h1>Административная панель</h1>
    <div class="row text-center">
        <div class="col-xs-6 col-sm-4 block">
            <a href="/admin/content">
                <img src="/img/admin/notepad.png">
                <h2>Категории</h2>
            </a>
        </div>
<!--         <div class="col-xs-6 col-sm-4 block">
            <a href="/admin/slider">
                <img src="/img/admin/picture.png">
                <h2>Слайдер</h2>
            </a>
        </div> -->
        <div class="col-xs-6 col-sm-4 block">
            <a href="/admin/settings">
                <img src="/img/admin/configuration.png">
                <h2>Настройки</h2>
            </a>
        </div>
        <div class="col-xs-6 col-sm-4 block">
            <a href="/admin/user">
                <img src="/img/admin/users.png">
                <h2>Администраторы</h2>
            </a>
        </div>

        <div class="col-xs-6 col-sm-4 block">
            <a href="/">
                <img src="/img/admin/star.png">
                <h2>Перейти на сайт</h2>
            </a>
        </div>
        <div class="col-xs-6 col-sm-4 block">
            <a href="/auth/logout">
                <img src="/img/admin/locked.png">
                <h2>Выйти</h2>
            </a>
        </div>
        <div class="col-xs-6 col-sm-4 block">
            <a href="/admin/user/{{Auth::user()->id}}">
                <img src="/img/admin/user-admin.png">
                <h2>Профиль</h2>
            </a>
        </div>
    </div>
</div>



@stop
