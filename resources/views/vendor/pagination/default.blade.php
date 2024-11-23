@if ($paginator->hasPages())

    <!-- <div class="pagination" id="pagination">
          <a href="">&laquo;</a>
          <a class="active" href="">1</a>
          <a href="">2</a>
          <a href="">3</a>
          <a href="">4</a>
          <a href="">5</a>
          <a href="">&raquo;</a>
        </div> -->


 
        <div class="pagination" id="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
               
            <a href="" style='opacity:0.3;pointer-event:none'>&laquo;</a>
            @else
               
                   <a href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                     <a href="" style='opacity:0.3;pointer-event:none'>{{ $element }}</a>
                @endif
 
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                             <a class="active" href="">{{ $page }}</a>
                        @else
                             <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                
                <a href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
            @else
                 
                <a href="" style='opacity:0.3;pointer-event:none'>&raquo;</a>
            @endif
      
    </div>
@endif
