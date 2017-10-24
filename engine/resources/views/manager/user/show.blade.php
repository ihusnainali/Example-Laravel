@extends('layouts.bootstrap')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-3 sidebar">
                <div class="mini-submenu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
                <div class="list-group">
                    <span href="#" class="list-group-item active">
                        Submenu
                        <span class="pull-right" id="slide-submenu">
                            <i class="fa fa-times"></i>
                        </span>
                    </span>
                    <a href="#" class="list-group-item">
                        <i class="fa fa-comment-o"></i> Lorem ipsum
                    </a>
                    <a href="#" class="list-group-item">
                        <i class="fa fa-folder-open-o"></i> Lorem ipsum <span class="badge">14</span>
                    </a>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Зарегистрированные пользователи</div>
                    <div class="panel-body">
                        <p>
                            Включенеые роли:<br>
                            <ul>
                            @foreach($userRoles as $userRole)
                                <li>{{$userRole['name']}}</li>
                            @endforeach
                            </ul>
                        </p>
                        <p>
                            Выключенеые роли:<br>
                        <ul>
                            @foreach($roles as $role)
                                <li>{{$role['name']}}</li>
                            @endforeach
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
