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
</style>

@endsection
@section('main')

    <main class="container">
      <h2 class="header-title">All My Posts</h2>
       
      @if(Session('status')) 
        <p style="background: green;color:white;padding:1rem "> {{ Session('status') }} </p>
         @endif 
       
      <section class="cards-blog latest-blog">

      @foreach($allPosts as $posts)

      @if(auth()->check() && auth()->user()->id === $posts->user->id)


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
      @endif




        @endforeach

   

       
     

     
      </section>
     

     
    @endsection