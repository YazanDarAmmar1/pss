<div>
    <!-- #breadcrumb -->
    <nav class="breadcrumb-box">
        <div class="container">
            <div class="bxp d-flex space-between flex-column-p gap-20 gap-65-p">
                <div class="right-side">
                    <ul class="list-none breadcrumb-in d-flex wrap gap-15">
                        <li>
                            <a class="body-color to-color" href="{{route('home')}}">الرئيسية</a>
                        </li>
                        <img class="flip-en" src="{{asset('home-assets/images/arrow-left.svg')}}" width="24" />
                        <li>
                            <p>مشاريعنا</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- ##breadcrumb -->

    <section class="projects-listing-section relative section-padding">

        <div class="container full-p">
            <div class="toggle-tabs toggle-tabs-mo theme-2  d-flex gap-15 pb-40 wrap">
                <button wire:click="selectedCategory({{ null }})" @class([
                       'toggle-tab-btn radius-30',
                       'active' =>$this->selected_category == null
                   ])>الكل</button>
                @foreach($this->project_category as $category)
                    <button
                        wire:click="selectedCategory({{ $category->id }})"
                        @class([
                            'toggle-tab-btn radius-30',
                            'active' =>$category->id == $this->selected_category
                        ])>
                        @if($category->id == 1)
                            <img src="{{asset('home-assets/images/star.svg')}}" width="24">
                        @endif
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
            <div class="container-p">
                <!-- #search -->
                <div class="search-box-custom d-flex">
                    <input wire:model.live.debounce.500="search" class="search-input" type="text" placeholder="ابحث عن مشروع ...">
                    <button class="btn-0 search-custom-btn">
                        <img src="{{asset('home-assets/images/search.svg')}}" width="20">
                    </button>
                </div>
                <!-- ##search -->
            </div>
        </div>
        <div class="container">
            <div class="box grid-3 grid-2-t grid-1-p gap-40 pt-40">
                @foreach($this->project_list as $project)
                  <livewire:home.projects.card-item :project="$project" key="{{$project->id}}"/>
                @endforeach

            </div>

            <!-- #pagination -->
            @if($this->project_list)
                {{$this->project_list->links('vendor.livewire.custom-pagination')}}
            @endif
            <!-- ##pagination -->
        </div>
    </section>
</div>
