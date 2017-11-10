@extends('layouts.app')
@section('content')
    <section class="allNews">
        <div class="container">
            <div class="sectionTitle">
                <h1>Новости</h1>
            </div>

            @if(!empty($news))
                <div class="news__item">
                    @foreach($news as $item)
                        <div class="allNews__item">
                            <h4 class="allNews__name">{{ $item['name'] }}</h4>
                            <span class="allNews__date">{{ date('d.m.Y', strtotime($item['created_at'])) }}</span>
                            <hr>
                            <p class="allNews__text">{{ $item['content'] }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="news__item">
                    <p>Новостей пока нет</p>
                </div>
            @endif

            <div class="allNews__controls">
                @if($currentPage > 0)
                    <a href="{{ url('news/page', ['id' => $currentPage - 1]) }}" class="allNews__prew">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
                @endif
                @if(($newsCount / $parPage) > 1 && ($newsCount / $parPage) > $currentPage)
                    <a href="{{ url('news/page', ['id' => $currentPage + 1]) }}" class="allNews__next">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </a>
                @endif
            </div>
        </div>
    </section>

    <div class="pagination">
        <a href="#" class="previous">&laquo;</a>
        <a href="#">1</a>
        <a href="#" class="active">2</a>
        <a href="#">3</a>
        <a href="#" class="next">&raquo;</a>
    </div>
@endsection