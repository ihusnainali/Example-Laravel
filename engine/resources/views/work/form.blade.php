@extends('layouts.app')

@section('content')

<section class="workAdd">
    <div class="container">

        <div class="sectionTitle">
            <h2>@lang('work.new')</h2>
        </div>

        {{ session('addWorkResult') }}
        <form method="post" action="{{ route('workProcess') }}" enctype="multipart/form-data" class="form workAddForm">
            {{ csrf_field() }}

            <div class="inputGroup{{ $errors->has('workName') ? ' has-error' : '' }}">
                <label for="workName">@lang('work.nameOfNewWork'):</label>
                <input type="text" name="workName" value="{{ !empty($work['workName']) ? $work['workName'] : null }}" required autofocus>
                <span class="errorText">
                @if ($errors->has('workName'))
                        <strong>{{ $errors->first('workName') }}</strong>
                    @endif
            </span>
            </div>

            <div class="inputGroup{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="qqq">@lang('work.descriptionOfNewWork'):</label>
                <textarea id="qqq" name="description" cols="80" rows="8" required>{{ !empty($work['description']) ? $work['description'] : null }}</textarea>
                <span class="errorText">
                @if ($errors->has('description'))
                        <strong>{{ $errors->first('description') }}</strong>
                    @endif
            </span>
            </div>

            <div class="inputGroup{{ $errors->has('tags') ? ' has-error' : '' }}">
                <label for="location">Теги:</label>
                <input type="text" name="tags">
                <span class="errorText">
                @if ($errors->has('tags'))
                        <strong>{{ $errors->first('tags') }}</strong>
                @endif
            </span>
                @if(!empty($work['tags']))
                    <div class="tags">
                        @foreach($work['tags'] as $tag)

                            <a id="tag_{{ $tag['id'] }}" href="{{ route('deleteFromWork', ['tagId' => $tag['id'], 'workId' => $work['id']]) }}" class="tag">
                                <span class="name">{{ $tag['tag'] }}</span>
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
{{--                            <a id="tag_{{ $tag['id'] }}" href="{{ route('deleteFromWork', ['tagId' => $tag['id'], 'workId' => $work['id']]) }}">{{ $tag['tag'] }}</a>--}}
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="inputGroup{{ $errors->has('images') ? ' has-error' : '' }}">
                <label for="images">@lang('work.photoOfNewWork'):</label>
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
                                {{--<p>{{ $image['link'] }} (<a href="{{ route('imageDeleteFromWork', ['workId' => $work['id'], 'imageId' => $image['id']]) }}">X</a>)</p>--}}
                            @endif

                        @endforeach
                    </div>
                @endif
            </div>

            <button type="submit" name="button" class="button">@lang('work.buttonOfNewWork')</button>
            @if(isset($work['id']))
                <input type="hidden" name="workId" value="{{ $work['id'] }}">
            @endif
        </form>
    </div>
</section>
@endsection