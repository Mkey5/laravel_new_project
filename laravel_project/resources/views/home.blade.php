@extends('layouts.app')

@section('content')
<script src="/solardomination/public/js/jquery-3.1.1.min.js"></script>
<script src="/solardomination/public/js/jquery.countdown.js"></script>
@if(!isset($user->homeplanet->name)) 
    <script type="text/javascript">
        document.getElementById('logout-form').submit();
    </script>
@endif
<style type="text/css">

    html{
        height: 100%;
        width: 100%;
    }
    body{
        height: 100%;
        width: 100%;
        background: #000000 url('/solardomination/public/images/home.jpg') no-repeat scroll center center / cover;
        background-attachment: fixed;
    }

    .big{
        text-transform: capitalize;
        font-weight: bold;
        font-size: 18px;
    }

    .panel-warning .panel-heading{
        /*background-image: linear-gradient(to bottom,#FEC724 0,#FC9E21 100%) !important;*/
    }
    .countdown{
        text-align: center;
    }

    td{
        text-align: center;
        color: black;
    }

    th{
        text-align: center;
    }

    .ships_losses{
        display: none;
    }

    .center{
        text-align: center;
    }

    .panel-default{
        background-color: transparent !important;
    }

    .panel-default > .panel-heading {
        color: white;
        background: none!important;
        background-color: rgba(0, 0, 0, 0.8) !important;
        border-color: #ddd;
    }

    .panel-default > .panel-body {
        color: white;
        background: none !important;
        background-color: rgba(0, 0, 0, 0.8) !important;
        border-color: #ddd;
    }

    .panel{
        display: none;
    }

    @media screen and (max-width: 790px) {

            .panel{
                display: block;
            }
        }
</style>

<div class="container">
@if(isset($defenceInProgress))
    @if($defenceInProgress == true)
        <div class="row">
                <div class="col-md-4 col-md-offset-4 borders">
                <div class="countdown alert alert-danger">
                    <p>You're under attack !</p>
                    <p><b>{{ $attacker_nick }}</b> sent his/hers fleet !</p>
                    <p>Time until enemy fleet arrives:</p> 
                    <p><b><span id="clock"></span></b></p>
                </div>

                    <script type="text/javascript">

                        $('#clock').countdown('{{ $year }}/{{ $month }}/{{ $day }} {{$hour }}:{{ $minute }}:{{ $second }}')
                        .on('update.countdown', function(event) {
                                var format = '%H:%M:%S';
                                if(event.offset.totalDays > 0) {
                                        format = '%-d day%!d ' + format;
                                }
                                if(event.offset.weeks > 0) {
                                        format = '%-w week%!w ' + format;
                                }
                                $(this).html(event.strftime(format));
                        })
                        .on('finish.countdown', function(event) {
                                $(this).html('The Battle is over ! Click to refresh page.')
                                        .parent().addClass('disabled').on('click', function(event){
                                            location.reload();
                                        });
                        });
                </script>
            </div>
        </div>
    @endif
@endif

@if(isset($attackInProgress))
    @if($attackInProgress == true)
        <div class="row">
                <div class="col-md-4 col-md-offset-4 borders">
                <div class="countdown alert alert-info">
                    <p>Your Fleet is on the way !</p>
                    <p>Time until attack:</p> 
                    <p><b><span id="clock_attack"></span></b></p>
                </div>

                    <script type="text/javascript">

                        $('#clock_attack').countdown('{{ $year_attack }}/{{ $month_attack }}/{{ $day_attack }} {{$hour_attack }}:{{ $minute_attack }}:{{ $second_attack }}')
                        .on('update.countdown', function(event) {
                                var format = '%H:%M:%S';
                                if(event.offset.totalDays > 0) {
                                        format = '%-d day%!d ' + format;
                                }
                                if(event.offset.weeks > 0) {
                                        format = '%-w week%!w ' + format;
                                }
                                $(this).html(event.strftime(format));
                        })
                        .on('finish.countdown', function(event) {
                                $(this).html('The Battle is over ! Click to refresh page.')
                                        .parent().addClass('disabled').on('click', function(event){
                                            location.reload();
                                        });
                        });
                </script>
            </div>
        </div>
    @endif

    @if($attackInProgress == false &&  isset($year_return))
        <div class="row">
                <div class="col-md-4 col-md-offset-4 borders">
                <div class="countdown alert alert-success">
                    <p>Your Fleet was <b>Victorious</b> !</p>
                    <p>After <b>{{ $user->fleet->name }}</b> returns , you can check the Battle Log for more details. You will find it on the bottom of this page. It will be visable after your first battle.</p>
                    <p>Time to return:</p> 
                    <p><b><span id="clock_return"></span></b></p>
                </div>

                    <script type="text/javascript">

                        $('#clock_return').countdown('{{ $year_return }}/{{ $month_return }}/{{ $day_return }} {{$hour_return }}:{{ $minute_return }}:{{ $second_return }}')
                        .on('update.countdown', function(event) {
                                var format = '%H:%M:%S';
                                if(event.offset.totalDays > 0) {
                                        format = '%-d day%!d ' + format;
                                }
                                if(event.offset.weeks > 0) {
                                        format = '%-w week%!w ' + format;
                                }
                                $(this).html(event.strftime(format));
                        })
                        .on('finish.countdown', function(event) {
                                $(this).html('The Battle is over ! Click to refresh page.')
                                        .parent().addClass('disabled').on('click', function(event){
                                            location.reload();
                                        });
                        });
                </script>
            </div>
        </div>
    @endif    
@endif
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading"><span class="big">News:</span> </div>

                <div class="panel-body">
                    <p>Guys , after the lounch yesterday I've encountered <b>some bugs</b> in the game ,but they have been taken care of <i class="glyphicon glyphicon-ok"></i>&nbsp;. <b>Sorry for that !</b> If you encounter some other bugs , please don't be shy to inform me. / solardomination@gmail.com | <a href="http://www.marekradkov.com/contacts.html" target="_blank">www.marekradkov.com/contacts.html</a> / </p>
                    <p><b>- Solar Domination Team -</b></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p> - Hi , <span class="big">{{ $user->nickname }}</span> ! At this page you will recieve information for updates of the game, system messages and so on. . .</p>
                    <p> - You can change your profile picture from the <b>Profile</b> page. When choosing a picture, look for image less than 2mb of size and preferably with a square shape. </p>
                    <p>
                        - When battle takes place , a window will pop-up at the top of this page. After the countdown you will see <b>"The Battle is over ! Click to refresh page."</b> . Don't rush to click it right the way , it may take up to 50sec for the updating of the battle log. Please be patient.
                    </p>
                    <p>
                        - New things on their way : <b>Ranking Page</b>. Soon after that : <i><u>Planet defence systems</u></i> , <i><u>New ships</u></i> and <i><u>New Buildings</u></i>.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
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
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">More about the game management</div>

                <div class="panel-body">
                    <p>As you can see , at the upper right corner of the window there is a drop-down menu with your name on it. This menu will be visable from all layers of the game. There you will find path to your <b>Home</b> , <b>Planet</b> , <b>Orbital Base</b> , <b>Radar</b> , <b>Profile</b> and of course a <b>Logout</b> button. </p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading">Feedback</div>

                <div class="panel-body">
                    <p>Your <b>Feedback</b> is very important for me , so if you need more info , encounter some bugs or just want to say Hi please send me a email to <b><i>solardomination@gmail.com</i></b> or use the simplest form in <a href="http://www.marekradkov.com/contacts.html" target="_blank">www.marekradkov.com/contacts.html</a>. Enjoy !</p>
                </div>
            </div>
        </div>
    </div>
    <br>
    @if($is = $user->battles->first())
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading center"><h2>Battle Logs</h2> <button id="display_log" class="btn btn-warning float">Display log</button></div>

                    <div class="panel-body ships_losses">
                        <h3>Last 5 Wins</h3>
                        <?php 
                            $battles = DB::table('battles')
                                    ->where('winner','=',$user->id)
                                    ->orderBy('id', 'desc')
                                    ->paginate(5);

                         ?>

                        @foreach($battles as $battle)
            
                            <?php 
                                
                                $attacker_log = DB::table('users')
                                    ->where('users.id','=',$battle->attacker)
                                    ->first();

                                $defender_log = DB::table('users')
                                    ->where('users.id','=',$battle->defender)
                                    ->first();

                                $winner_log = DB::table('users')
                                    ->where('users.id','=',$battle->winner)
                                    ->first();

                            ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Attacker</th>
                                            <th>Defender</th>
                                            <th>Winner</th>
                                            <th>Ships /winner/</th>
                                            <th>Ships /loser/</th>
                                            <th>Gold /earned/</th>
                                            <th>Metal /earned/</th>
                                            <th>Energy /earned/</th>
                                            <th>Time of Attack</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="/solardomination/public/uploads/avatars/{{ $attacker_log->avatar }}" style="height:32px; width: 32px; border-radius: 50%;"> 
                                                <p>{{ $attacker_log->nickname}}</p>
                                            </td>
                                            <td>
                                                <img src="/solardomination/public/uploads/avatars/{{ $defender_log->avatar }}" style="height:32px; width: 32px; border-radius: 50%;"> 
                                                <p>{{ $defender_log->nickname}}</p>
                                            </td>
                                            <td>
                                                <img src="/solardomination/public/uploads/avatars/{{ $winner_log->avatar }}" style="height:32px; width: 32px; border-radius: 50%;"> 
                                                <p>{{ $winner_log->nickname}}</p>
                                            </td>
                                            <td>
                                                <img src="/solardomination/public/images/fleet.jpg" style="height:32px; width: 32px; border-radius: 50%;"> 
                                                <p><b>{{ $battle->ships_losses * 100 }}% - lost</b></p>
                                            </td>
                                            <td>
                                                <img src="/solardomination/public/images/fleet.jpg" style="height:32px; width: 32px; border-radius: 50%;"> 
                                                <p><b>100% - lost</b></p>

                                            </td>
                                            <td>
                                                <img src="/solardomination/public/images/gold.jpg" style="height:32px; width: 32px; border-radius: 50%;"> 
                                                <p>{{ $battle->gold }}</p>
                                            </td>
                                            <td>
                                                <img src="/solardomination/public/images/metal.jpg" style="height:32px; width: 32px; border-radius: 50%;"> 
                                                <p>{{ $battle->metal }}</p>
                                            </td>
                                            <td>
                                                <img src="/solardomination/public/images/gold.jpg" style="height:32px; width: 32px; border-radius: 50%;"> 
                                                <p>{{ $battle->energy }}</p>
                                            </td>
                                            <td>
                                                {{ $battle->created_at }}
                                            </td>
                                           
                                        </tr>
                                    </tbody>
                                </table>                        
                        @endforeach
                        <br>

                        <h3>Last 5 losses</h3>
                        <?php 
                            $battles = DB::table('battles')
                                    ->where('loser','=',$user->id)
                                    ->orderBy('id', 'desc')
                                    ->paginate(5);

                         ?>

                        @foreach($battles as $battle)
            
                            <?php 
                                
                                $attacker_log = DB::table('users')
                                    ->where('users.id','=',$battle->attacker)
                                    ->first();

                                $defender_log = DB::table('users')
                                    ->where('users.id','=',$battle->defender)
                                    ->first();

                                $winner_log = DB::table('users')
                                    ->where('users.id','=',$battle->winner)
                                    ->first();

                            ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Attacker</th>
                                            <th>Defender</th>
                                            <th>Winner</th>
                                            <th>Ships /winner/</th>
                                            <th>Ships /loser/</th>
                                            <th>Gold /earned/</th>
                                            <th>Metal /earned/</th>
                                            <th>Energy /earned/</th>
                                            <th>Time of Attack</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="/solardomination/public/uploads/avatars/{{ $attacker_log->avatar }}" style="height:32px; width: 32px; border-radius: 50%;"> 
                                                <p>{{ $attacker_log->nickname}}</p>
                                            </td>
                                            <td>
                                                <img src="/solardomination/public/uploads/avatars/{{ $defender_log->avatar }}" style="height:32px; width: 32px; border-radius: 50%;"> 
                                                <p>{{ $defender_log->nickname}}</p>
                                            </td>
                                            <td>
                                                <img src="/solardomination/public/uploads/avatars/{{ $winner_log->avatar }}" style="height:32px; width: 32px; border-radius: 50%;"> 
                                                <p>{{ $winner_log->nickname}}</p>
                                            </td>
                                            <td>
                                                <img src="/solardomination/public/images/fleet.jpg" style="height:32px; width: 32px; border-radius: 50%;"> 
                                                <p><b>{{ $battle->ships_losses * 100 }}% - lost</b></p>
                                            </td>
                                            <td>
                                                <img src="/solardomination/public/images/fleet.jpg" style="height:32px; width: 32px; border-radius: 50%;"> 
                                                <p><b>100% - lost</b></p>

                                            </td>
                                            <td>
                                                <img src="/solardomination/public/images/gold.jpg" style="height:32px; width: 32px; border-radius: 50%;"> 
                                                <p>{{ $battle->gold }}</p>
                                            </td>
                                            <td>
                                                <img src="/solardomination/public/images/metal.jpg" style="height:32px; width: 32px; border-radius: 50%;"> 
                                                <p>{{ $battle->metal }}</p>
                                            </td>
                                            <td>
                                                <img src="/solardomination/public/images/gold.jpg" style="height:32px; width: 32px; border-radius: 50%;"> 
                                                <p>{{ $battle->energy }}</p>
                                            </td>
                                            <td>
                                                {{ $battle->created_at }}
                                            </td>
                                           
                                        </tr>
                                    </tbody>
                                </table>                        
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <br>
    @endif
</div>

<script type="text/javascript">
    
    $(function(){
        $("#display_log").click(function(){
            $('.ships_losses').toggle(1000);
        });

       var w = window.innerWidth
                    || document.documentElement.clientWidth
                    || document.body.clientWidth;

        if( w >= 790){
           $('.panel').slideDown(2000);
        }
    });

</script>
@endsection
