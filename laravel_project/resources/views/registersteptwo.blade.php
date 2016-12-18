@extends('layouts.mandatory')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <img src="/solardomination/public/uploads/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; border-radius: 50%; float: left; margin-right: 25px; margin-bottom: 20px;">
        </div>
        <div class="col-md-8 col-md-offset-1">
        
            <h2>Hello ,{{ $user->name }} ! Let's config few things more :</h2>
            <br>
            <form class="form-horizontal " role="form" action="{{ url('/register-step-2') }}" method="POST">

                {{ csrf_field() }}

                <div class="form-group{{ isset($errors['homeplanet_name']) ? ' has-error' : '' }}">
                    <label for="homeplanet_name" class="col-md-4 control-label">Home Planet Name:</label>

                    <div class="col-md-6">
                        <input id="homeplanet_name" type="text" class="form-control" name="homeplanet_name" value="" required autofocus>

                        @if (isset($errors['homeplanet_name']))
                              <span class="help-block">
                                  <strong>{{ $errors['homeplanet_name']['name'][0] }}</strong>
                              </span>
                          @endif
                    </div>
                </div>

                <div class="form-group{{ isset($errors['orbitalbase_name']) ? ' has-error' : '' }}">
                    <label for="orbitalbase_name" class="col-md-4 control-label">Orbital Base Name:</label>

                    <div class="col-md-6">
                        <input id="orbitalbase_name" type="text" class="form-control" name="orbitalbase_name" value="" required autofocus>

                        @if (isset($errors['orbitalbase_name']))
                              <span class="help-block">
                                  <strong>{{ $errors['orbitalbase_name']['name'][0] }}</strong>
                              </span>
                          @endif
                    </div>
                </div>

                <div class="form-group{{ isset($errors['fleet_name']) ? ' has-error' : '' }}">
                    <label for="fleet_name" class="col-md-4 control-label">Fleet Name:</label>

                    <div class="col-md-6">
                        <input id="fleet_name" type="text" class="form-control" name="fleet_name" value="" required autofocus>

                        @if (isset($errors['fleet_name']))
                              <span class="help-block">
                                  <strong>{{ $errors['fleet_name']['name'][0] }}</strong>
                              </span>
                          @endif
                    </div>
                </div>

                <div class="form-group{{ isset($errors['homeplanet_name']['galaxy']) ? ' has-error' : '' }}">
                    <label for="galaxy" class="col-md-4 control-label">Select Galaxy:</label>

                    <div class="col-md-6">
                        <select class="form-control" name="galaxy" id="galaxy" required autofocus>
                            <option selected disabled>- Choose Galaxy -</option>
                            <option value="Andromeda">Andromeda</option>
                            
                        </select>
                        <p>More Galaxies soon !</p>
                        @if (isset($errors['homeplanet_name']['galaxy']))
                              <span class="help-block">
                                  <strong>{{ $errors['homeplanet_name']['galaxy'][0] }}</strong>
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
          
                // <option value="Milky Way">Milky Way</option>
                // <option value="Black Eye">Black Eye</option>
                // <option value="Centaurus A">Centaurus A</option>
                
            ?>
        </div>
    </div>
</div>
@endsection
