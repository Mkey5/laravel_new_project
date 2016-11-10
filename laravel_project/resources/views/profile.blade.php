@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <img src="/uploads/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; border-radius: 50%; float: left; margin-right: 25px;">
            <h2>{{ $user->name }}'s profile</h2>
            <form enctype="multipart/form-data" action="/profile" method="POST">
                <label>Update Profile picture</label>
                <input type="file" name="avatar">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" value="submit" class="pull-right btn btn-sm btn-primary">
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
    </div>
</div>
@endsection
