@extends('layouts.app')

@section('content')

    <section class="workAdd">
        <div class="container">

            <div class="sectionTitle">
                <h2>@lang('work.new')</h2>
            </div>

            <form method="post" action="{{ route('workProcess') }}" enctype="multipart/form-data" class="form workAddForm">
                {{ csrf_field() }}

                <div class="inputGroup{{ $errors->has('workName') ? ' has-error' : '' }}">
                    <label for="workName">@lang('work.nameOfNewWork'):</label>
                    <input id="workName" type="text" name="workName" value="{{ !empty($work['workName']) ? $work['workName'] : null }}" required>
                    <span class="errorText">
                        @if ($errors->has('workName'))
                            <strong>{{ $errors->first('workName') }}</strong>
                        @endif
                    </span>
                </div>

                <div class="inputGroup{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="desc">@lang('work.descriptionOfNewWork'):</label>
                    <textarea id="desc" name="description" cols="80" rows="8"
                              required>{{ !empty($work['description']) ? $work['description'] : null }}</textarea>
                    <span class="errorText">
                        @if ($errors->has('description'))
                            <strong>{{ $errors->first('description') }}</strong>
                        @endif
                    </span>
                </div>

                {{--<div class="inputGroup{{ $errors->has('tags') ? ' has-error' : '' }}">--}}
                    {{--<label for="tags">Теги:</label>--}}
                    {{--<input id="tags" type="text" name="tags" placeholder="добавьте теги через ',' ">--}}
                    {{--<span class="errorText">--}}
                        {{--@if ($errors->has('tags'))--}}
                            {{--<strong>{{ $errors->first('tags') }}</strong>--}}
                        {{--@endif--}}
                    {{--</span>--}}
                    {{--@if(!empty($work['tags']))--}}
                        {{--<p>Теги работы:</p>--}}
                        {{--<div class="tag">--}}
                            {{--@foreach($work['tags'] as $tag)--}}
                                {{--<a id="tag_{{ $tag['id'] }}" href="{{ route('deleteFromWork', ['tagId' => $tag['id'], 'workId' => $work['id']]) }}"--}}
                                   {{--class="tag__item">--}}
                                    {{--<span class="name">{{ $tag['tag'] }}</span>--}}
                                    {{--<i class="fa fa-trash" aria-hidden="true"></i>--}}
                                {{--</a>--}}
                            {{--@endforeach--}}
                        {{--</div>--}}
                    {{--@endif--}}
                {{--</div>--}}

                {{--{{ var_dump($work['materials']) }}--}}
                @if(!empty($work['id']))
                    <p>Категории работы:</p>
                    @if(empty($work['categories']['inWork']))
                        <p>Вы не добавили свою работу не в одну категорию</p>
                    @else
                        <div class="category">
                            @foreach($work['categories']['inWork'] as $category)
                                <a href="{{ route('deleteFromCategory', ['workId' => $work['id'], 'catId' => $category['id']]) }}" id="dcid_{{ $category['id'] }}" class="category__item">
                                    <span class="name">{{ $category['name'] }}</span>
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            @endforeach
                        </div>
                    @endif
                    <p>Все категории:</p>
                    @if(empty($work['categories']['notInWork']))
                        <p>Ваша работа сейчас во всех возможных категориях</p>
                    @else
                        <div id="notInWork" class="inputGroup checkboxes">
                            @foreach($work['categories']['notInWork'] as $category)
                                <input id="{{ $category['id'] }}" type="checkbox" name="categories[]" value="{{ $category['id'] }}">
                                <label for="{{ $category['id'] }}">{{ $category['name'] }}</label>
                            @endforeach
                        </div>
                    @endif
                    <input type="hidden" name="workId" value="{{ $work['id'] }}">
                @else
                    <div class="inputGroup checkboxes">
                        @foreach($categories as $category)
                            <input id="{{ $category['id'] }}" type="checkbox" name="categories[]" value="{{ $category['id'] }}">
                            <label for="{{ $category['id'] }}">{{ $category['name'] }}</label>
                        @endforeach
                    </div>
                @endif

                <div class="inputGroup{{ $errors->has('images') ? ' has-error' : '' }}">
                    <label for="images">@lang('work.photoOfNewWork') (16:9, jpeg):</label>
                    <div class="filearea">
                        <span>@lang('work.photoDescrOfNewWork')</span>
                        <input type="file" name="images[]" value="{{ old('images') }}" multiple {{ !empty($errors->has('images')) ? 'required' : null }}>
                    </div>
                    <div class="fileareaPreview"></div>
                    <span class="errorText">
                        @if ($errors->has('images'))
                            <strong>{{ $errors->first('images') }}</strong>
                        @endif
                    </span>
                    @if(!empty($work['images']))
                        <div class="imageGroup">
                            @foreach($work['images'] as $image)

                                @if($image['isDefault'])
                                    <div class="image">
                                        <div class="default">
                                            <i class="fa fa-check-square" aria-hidden="true"></i>
                                        </div>
                                        <img src="{{ $image['link'] }}" alt="">
                                        <a href="{{ route('imageDeleteFromWork', ['workId' => $work['id'], 'imageId' => $image['id']]) }}" class="del">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                @else
                                    <div class="image">
                                        <img src="{{ $image['link'] }}" alt="">
                                        <a href="{{ route('imageDeleteFromWork', ['workId' => $work['id'], 'imageId' => $image['id']]) }}" class="del">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>

                <button type="submit" name="button" class="button">@lang('work.buttonOfNewWork')</button>
            </form>
        </div>
    </section>
@endsection



