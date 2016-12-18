@extends('layouts.app')

@section('content')
<style type="text/css">
    @media screen and (max-width: 790px) {
        table , .hidesmall {
            display: none;
        }
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
        <img src="/solardomination/public/uploads/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; border-radius: 50%; float: left; margin-right: 25px;">
            <h2>{{ $user->name }}'s profile</h2>
            <form enctype="multipart/form-data" action="{{ url('/profile') }}" method="POST">
                <label>Update Profile picture /2mb max/</label>
                <input type="file" name="avatar">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <br>
                <input type="submit" value="submit" class="pull-right btn btn-md btn-primary" style="margin-right: 140px;">
                <br>
                <br>
                <br>
            </form>
            

            <?php
            try{
                if(!isset($error)){
                    throw new Exception('');
                }else{
                    echo $error['image'][0];
                }
            }
            catch(Exception $e) {
              echo $e->getMessage();
            }
                
            ?>
        </div>
        
        <div class="col-md-6">
            <p><a class="btn btn-md btn-primary" href="{{ url('/homeplanet') }}">Go to Home Planet &nbsp;<i class="glyphicon glyphicon-globe"></i></a></p>
            <p><a class="btn btn-md btn-warning" href="{{ url('/orbitalbase') }}">Go to Orbital Base &nbsp;<i class="glyphicon glyphicon-map-marker"></i></a></p>
            <p><a class="btn btn-md btn-success" href="{{ url('/radar') }}">Go to Radar &nbsp;<i class="glyphicon glyphicon-search"></i></a></p>


        </div>
    </div>

    <style type="text/css">
        thead{
            font-weight: bold;
            color: black;   
        }

    </style>
    <br>
    <div class="row">
        <div class="col-md-8">
            <h2 class="hidesmall">Your stats:</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User info:</th>
                        <th>Name</th>
                        <th>Nickname</th>
                        <th>Battles Won</th>
                        <th>Battles Lost</th>
                        <th>Level</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="position: relative;">
                            <img src="/solardomination/public/uploads/avatars/{{ Auth::user()->avatar }}" style="height:32px; width: 32px; position: absolute; top: 3px; left: 10px; border-radius: 50%;">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->nickname }}</td>
                        <td>{{ $user->battles_won }}</td>
                        <td>{{ $user->battles_lost }}</td>
                        <td>{{ $user->level }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Home Planet:</th>
                        <th>Name</th>
                        <th>Gold</th>
                        <th>Metal</th>
                        <th>Energy</th>
                        <th>Coordinate X</th>
                        <th>Coordinate Y</th>
                        <th>Galaxy</th>
                        <th>Orbital Base:</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="position: relative;">
                            <img src="/solardomination/public/images/homeplanet.png" style="height:32px; width: 32px; position: absolute; top: 3px; left: 10px; border-radius: 50%;">
                        </td>
                        <td>{{ $user->homeplanet->name }}</td>
                        <td>{{ $user->homeplanet->gold }}</td>
                        <td>{{ $user->homeplanet->metal }}</td>
                        <td>{{ $user->homeplanet->energy }}</td>
                        <td>{{ $user->homeplanet->x }}</td>
                        <td>{{ $user->homeplanet->y }}</td>
                        <td>{{ $user->homeplanet->galaxy }}</td>
                        <td style="position: relative;">
                            <img src="/solardomination/public/images/orbitalbase.jpg" style="height:32px; width: 32px; position: absolute; top: 3px; left: 10px; border-radius: 50%;">
                        </td>
                        <td>{{ $user->orbitalbase->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
     <div class="row">
        <div class="col-md-10">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fleet Status:</th>
                        <th>Name</th>
                        <th>Frigates</th>
                        <th>Corvettes</th>
                        <th>Destroyers</th>
                        <th>Assault Carriers</th>
                        <th>Fleet Attack</th>
                        <th>Fleet Defence</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="position: relative;">
                            <img src="/solardomination/public/images/fleet.jpg" style="height:32px; width: 32px; position: absolute; top: 3px; left: 10px; border-radius: 50%;">
                        </td>
                        <td>{{ $user->fleet->name }}</td>
                        <td>{{ $user->fleet->frigate }}</td>
                        <td>{{ $user->fleet->corvette }}</td>
                        <td>{{ $user->fleet->destroyer }}</td>
                        <td>{{ $user->fleet->assault_carrier }}</td>
                        <td>{{ $user->fleet->attack }}</td>
                        <td>{{ $user->fleet->defence }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
