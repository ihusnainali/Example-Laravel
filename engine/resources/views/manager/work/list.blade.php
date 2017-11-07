@extends('layouts.manager')

@section('content')
    <div class="container">
        <div class="row">
            @include('manager.shared.menu')
            <div class="col-md-8 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Не проверенные работы</div>
                    <div class="panel-body">
                        @if (empty($works))
                            <p>Пользователей нет! Что оооочень странно.</p>
                        @else
                            <table class="table table-hover table-responsive">
                                <tr>
                                    <td>ID</td>
                                    <td>Имя</td>
                                    <td>автор</td>
                                    <td>Просмотреть</td>
                                    <td>Проверена</td>
                                </tr>
                                @foreach ($works as $work)
                                    <tr>
                                        <td>{{ $work['id'] }}</td>
                                        <td>{{ $work['workName'] }}</td>
                                        <td><a href="{{ route('workListAuthorManager', ['id' => $work['id']]) }}">{{ $work['userName'] }}</a></td>
                                        <td><a href="{{ route('workShow', ['id' => $work['id']]) }}">show</a> </td>
                                        <td><input data-url="{{ route('managerWorkApprove', ['workId' => $work['id']]) }}" id="work_{{ $work['id'] }}" type="checkbox" {{ empty($work['approved']) ? null : 'checked' }}></td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
