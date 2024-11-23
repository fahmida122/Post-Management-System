@extends('layouts.index')

@section('stylesheet')
<style>
  h4{display:flex;
  width:100%;
  justify-content:space-between;
  align-items:center;
  }
  h4 .links{
    display:flex; 
  justify-content:center;
  align-items:center;
  }
  h4 .links form{
    margin-left:15px
  }

  .paginationBody{
    margin:0 auto; width:100%;    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>

@endsection
@section('main')

    <main class="container">
      <h2 class="header-title">All Blog Posts</h2>
      <div class="searchbar">
        <form action="">
          <input type="text" placeholder="Search..." name="search" />

          <button type="submit">
            <i class="fa fa-search"></i>
          </button>

        </form>
      </div>
      @if(Session('status')) 
        <p style="background: green;color:white;padding:1rem "> {{ Session('status') }} </p>
         @endif 
      <div class="categories">
        <ul>
        @foreach($fullCategory as $c)
         <li><a href="{{route('blog.index', ['category' => $c->name])}}">{{$c->name}}</a></li>
      @endforeach

         
        </ul>
      </div>
      <section class="cards-blog latest-blog">

      @forelse($allPosts as $posts)

        <div class="card-blog-content">
          <img src="{{asset($posts->imagePath)}}" alt="" />
          <p>
          {{$posts->created_at->diffForHumans()	}}
            <span>Written By {{$posts->user->name}} </span>
          </p>
          <h4>
            <a href="{{route('blog.single', $posts)}}"> {{$posts->title}} </a>
@auth
@if(auth()->check() && auth()->user()->id === $posts->user->id)  
            <div class="links">
                <a href="{{route('blog.edit', $posts)}}" class='btn btn-primary'>Edit</a>
                <form action="{{route('blog.delete',$posts)}}" method='POST'>
                @csrf
      @method('DELETE')

                  <!-- <a href="javascript:void(0)" type='submit' value='Delete' class='btn btn-danger'>Delete</a> -->
                  <button type="submit" class="btn btn-danger">Delete</button>

                </form>
            </div>
            @endif            
@endauth
          </h4>
        </div>
        @empty
     
        <p style="background: Red;color:white;padding:1rem ">   No Post Found </p>


        @endforelse

   

       
     

     
      </section>
         <!-- pagination -->
         <!-- <div class="pagination" id="pagination">
          <a href="">&laquo;</a>
          <a class="active" href="">1</a>
          <a href="">2</a>
          <a href="">3</a>
          <a href="">4</a>
          <a href="">5</a>
          <a href="">&raquo;</a>
        </div> -->

        <div class='paginationBody'>
        {{$allPosts->links('pagination::default')}}
        </div>
     
     
    @endsection