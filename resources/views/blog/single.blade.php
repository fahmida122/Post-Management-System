
@extends('layouts.index')

     
     @section('main')
     
     
     <main class="container">
      <section class="single-blog-post">
        <h1> {{$singlePost->title}}</h1>

        <p class="time-and-author">
        {{$singlePost->created_at->diffForHumans()	}}
          <span>Written By {{$singlePost->user->name}} </span>
        </p>

        <div class="single-blog-post-ContentImage" data-aos="fade-left">
          <img src="{{asset($singlePost->imagePath)}}" alt="" />
        </div>

        <div class="about-text">
        {!!$singlePost->body!!}
        </div>
      </section>



      

      <section class="recommended">
        <p>Related</p>
        <div class="recommended-cards">
       
         

          @foreach($relatedPosts as $RP)
          <a href="{{$RP->slug}}">
            <div class="recommended-card">
            <img src="{{asset($RP->imagePath)}}" alt="" />

              <h4>
              {{$RP->title}}
              </h4>
            </div>
          </a>
          @endforeach
      

        </div>
      </section>
    </main>
    @endsection