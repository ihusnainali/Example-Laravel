@extends('layouts.app')

@section('content')

<section class="workAdd">
    <div class="container">

        <div class="sectionTitle">
            <h2>@lang('work.edit')</h2>
        </div>

        {{ session('results') }}
        <form method="post" action="{{ route('workAddProcess') }}" enctype="multipart/form-data" class="form registrationForm">
            {{ csrf_field() }}

            <div class="inputGroup{{ $errors->has('workName') ? ' has-error' : '' }}">
                <label for="workName">@lang('work.nameOfNewWork'):</label>
                <input type="text" name="workName" value="{{ $work['workName'] }}" required autofocus>
                <span class="errorText">
                    @if ($errors->has('workName'))
                        <strong>{{ $errors->first('workName') }}</strong>
                    @endif
                </span>
            </div>

            <div class="inputGroup{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="location">@lang('work.descriptionOfNewWork'):</label>
                <textarea id="summernote" name="description" cols="80" rows="8" required>
                    {{ $work['description'] }}
                </textarea>
                <span class="errorText">
                    @if ($errors->has('description'))
                        <strong>{{ $errors->first('description') }}</strong>
                    @endif
                </span>
            </div>
            @if(!empty($images))
                @foreach($images as $image)
                    @if($image['isDefault'])
                        <p>изображение по умолчанию - {{ $image['link'] }} (<a href="{{ route('imageDeleteFromWork', ['workId' => $work['id'], 'imageId' => $image['id']]) }}">X</a>)</p>
                    @else
                        <p>{{ $image['link'] }} (<a href="{{ route('imageDeleteFromWork', ['workId' => $work['id'], 'imageId' => $image['id']]) }}">X</a>)</p>
                    @endif

                @endforeach
            @endif
            <div class="inputGroup{{ $errors->has('images') ? ' has-error' : '' }}">
                <label for="images">@lang('work.photoOfNewWork'):</label>
                <div class="filearea">
                    <span>@lang('work.photoDescrOfNewWork')</span>
                    <input type="file" name="images[]" value="{{ old('images') }}" multiple required>
                </div>
                <span class="errorText">
                    @if ($errors->has('images'))
                        <strong>{{ $errors->first('images') }}</strong>
                    @endif
                </span>
            </div>

            <button type="submit" name="button" class="button">@lang('work.buttonOfNewWork')</button>
            <input type="hidden" name="workId" value="{{ $work['id'] }}">
        </form>
    </div>
</section>
@endsection