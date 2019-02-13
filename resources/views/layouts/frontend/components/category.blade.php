@if(isset($categories))
    @if(count($categories))
        <div class="list-categories">
            <p class="sidebar-title">
                <i class="fa fa-th-list" aria-hidden="true"></i>Danh mục
            </p>
            <div class="categories">
                @foreach($categories as $category)
                    <div class="item-sidebar">
                        <span class="fa fa-arrow-circle-o-right" aria-hidden="true"></span>
                        <a href="{{route('frontend.category', [''])}}" title="Cấy ghép IMPLANT"
                           data-toggle="tooltip">{{$category->title}}</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endif
