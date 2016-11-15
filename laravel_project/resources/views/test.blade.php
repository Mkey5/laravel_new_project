@extends('layouts.mandatory')

@section('content')



	<?php   var_dump($errors);

		echo "<br>" . $errors['fleet_name']['name'][0];



	  ?>
	  @if (isset($errors['fleet_name']))
          <span class="help-block">
              <strong>{{ $errors['fleet_name']['name'][0] }}</strong>
          </span>
      @endif

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



@endsection