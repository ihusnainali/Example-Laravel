@extends('layouts.app')

@section('content')
    <section class="gallery">
        <div class="gallery__wrap">
            <div class="galleryCategory galleryCategory_opened">
                <div class="galleryCategory__title">
                    <span>Категории</span>
                    <a href="#"></a>
                </div>
                <ul class="galleryCategory__list">
                    @foreach($categories as $category)
                        <li>
                            <input type="checkbox" class="checkbox" id="{{ $category['id'] }}"/>
                            <label for="{{ $category['id'] }}">{{ $category['name'] }}</label>
                        </li>
                    @endforeach
                </ul>

            </div>

            <div class="galleryWorks">
                <div class="galleryWorks__best">
                    <div class="sectionTitle">
                        <h2>Лучшие работы</h2>
                    </div>
                    <div class="products">
                        <div class="products__wrap">
                            @foreach($recentlyLiked as $work)
                                <a href="/author/{{ $work['userId'] }}" class="item">
                                    <div class="content">
                                        <div class="border">
                                            <div class="valign">
                                                <h3>{{ $work['workName'] }}</h3>
                                                <p>{{ $work['description'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="{{ url($work['link']) }}" alt="">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="galleryWorks__all">
                    <div class="sectionTitle">
                        <h2>Все работы</h2>
                    </div>

                    <div class="products">
                        <div class="products__wrap">
                            @if(empty($list))
                                <p>В этой категории работ нет</p>
                            @else
                                @foreach($list as $work)
                                    <a href="/author/{{ $work['userId'] }}" class="item">
                                        <div class="content">
                                            <div class="border">
                                                <div class="valign">
                                                        <h3>{{ $work['workName'] }}</h3>
                                                        <p>{{ $work['description'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="{{ url($work['link']) }}" alt="">
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
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