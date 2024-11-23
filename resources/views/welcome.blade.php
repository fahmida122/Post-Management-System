  
@extends('layouts.index')

     
@section('main')
       <!-- main -->
       <header class="header">
        <div class="header-text">
          <h1>UiMonk Blog</h1>
          <h4>Home of verified news...</h4>
        </div>
        <div class="overlay"></div>
      </header>
      <main class="container">
        <h2 class="header-title">Latest Blog Posts</h2>
        <section class="cards-blog latest-blog">


 
      @foreach($allPosts as $posts)
        <div class="card-blog-content">
          <img src="{{$posts->imagePath}}" alt="" />
          <p>
          {{$posts->created_at->diffForHumans()	}}
            <span>Written By {{$posts->user->name}} </span>
          </p>
          <h4>
            <a href="{{route('blog.single', $posts)}}"> {{$posts->title}} </a>
          </h4>
        </div>
        @endforeach
         

  

     
        </section>
      </main>


      @endsection
