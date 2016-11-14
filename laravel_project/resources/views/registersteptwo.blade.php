@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <img src="/uploads/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; border-radius: 50%; float: left; margin-right: 25px;">
            <h2>Hello ,{{ $user->name }} ! Let's config few things more :</h2>
            <form class="form-horizontal" role="form" action="/register-step-2" method="POST">

                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('homeplanet_name') ? ' has-error' : '' }}">
                    <label for="homeplanet_name" class="col-md-4 control-label">Home Planet Name</label>

                    <div class="col-md-6">
                        <input id="homeplanet_name" type="text" class="form-control" name="homeplanet_name" value="" required autofocus>

                        @if ($errors->has('homeplanet_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('homeplanet_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('orbitalbase_name') ? ' has-error' : '' }}">
                    <label for="orbitalbase_name" class="col-md-4 control-label">Orbital Base Name</label>

                    <div class="col-md-6">
                        <input id="orbitalbase_name" type="text" class="form-control" name="orbitalbase_name" value="" required autofocus>

                        @if ($errors->has('orbitalbase_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('orbitalbase_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('fleet_name') ? ' has-error' : '' }}">
                    <label for="fleet_name" class="col-md-4 control-label">Fleet Name</label>

                    <div class="col-md-6">
                        <input id="fleet_name" type="text" class="form-control" name="fleet_name" value="" required autofocus>

                        @if ($errors->has('fleet_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fleet_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>

            </form>
          

            <?php
            // try{
            //     if(!isset($error)){
            //         throw new Exception('');
            //     }else{
            //         echo $error['image'][0];
            //     }
            // }
            // catch(Exception $e) {
            //   echo $e->getMessage();
            // }
                
            ?>
        </div>
    </div>
</div>
@endsection
