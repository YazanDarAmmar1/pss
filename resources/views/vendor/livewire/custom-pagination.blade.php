@if ($paginator->hasPages())
    <div class="pagination wrap flex-all gap-15 pt-40">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="btn-0 flex-all disabled"><img class="flip" src="{{asset('home-assets/images/chev-left.svg')}}" width="30" height="30"/></a>
        @else
            <a wire:click="previousPage" wire:loading.attr="disabled" class="btn-0 flex-all"><img class="flip" src="{{asset('home-assets/images/chev-left.svg')}}" width="30" height="30"/></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="pagination-item flex-all active">{{ $page }}</a>
                    @else
                        <a wire:click="gotoPage({{ $page }})" class="pagination-item flex-all">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a wire:click="nextPage" wire:loading.attr="disabled" class="btn-0 flex-all"><img src="{{asset('home-assets/images/chev-left.svg')}}" width="30" height="30"/></a>
        @else
            <a class="btn-0 flex-all disabled"><img src="{{asset('home-assets/images/chev-left.svg')}}" width="30" height="30"/></a>
        @endif

        <span class="font-13 pagination-status">
            {{ $paginator->currentPage() }} من {{ $paginator->lastPage() }}
        </span>
    </div>
@endif
