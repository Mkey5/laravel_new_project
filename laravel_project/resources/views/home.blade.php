@extends('layouts.app')

@section('content')

<style type="text/css">

    html{
        height: 100%;
        width: 100%;
    }
    body{
        height: 100%;
        width: 100%;
        background: url('/images/home.jpg') no-repeat scroll center center / cover;
        background-attachment: fixed;
    }

    .big{
        text-transform: capitalize;
        font-weight: bold;
    }

    .panel-warning .panel-heading{
        /*background-image: linear-gradient(to bottom,#FEC724 0,#FC9E21 100%) !important;*/
    }

</style>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p>Hi , <span class="big">{{ $user->nickname }}</span> ! At this page you will recieve information for updates of the game, system messages and so on. . .</p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-warning">
                <div class="panel-heading">Warning</div>

                <div class="panel-body">
                    <p> A little tip. Be shure to check <b>regularly</b> your home page for attack messages !</p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">More about the game</div>

                <div class="panel-body">
                    <p>As you can see , at the upper right corner of the window there is a drop-down menu with your name on it. This menu will be visable from all layers of the game. There you will find path to your <b>Home</b> , <b>Planet</b> , <b>Orbital Base</b> , <b>Radar</b> , <b>Profile</b> and of course a <b>Logout</b> button. </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
