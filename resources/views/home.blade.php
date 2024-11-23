@extends('layouts.index')
@section('stylesheet')
<style>
    a{
        white-space:nowrap!important
    }
</style>
@endsection

@section('main')
<div class="container" style='margin-top:150px'>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                @if(Auth::check())
                    Welcome, {{ Auth::user()->name }}!
                   

                @else
                    Please log in to view this content.
                @endif


                <div class="container mt-5" style='max-width:1200px'>
              <div class="row mb-3">
                <div class="col">  <a href="{{route('blog.create')}}" class='btn btn-success' >Create Post</a>
              
                    </div>
                <div class="col">      <a href="{{route('home.mypost')}}" class='btn btn-success'>My Posts</a></div>
                <div class="col">      <a href="{{route('category.create')}}" class='btn btn-primary'>Create Category</a></div>
                <div class="col"><a href="{{route('category.index')}}" class='btn btn-primary'>Categories List</a></div>
                <div class="col">   <form action="/logout" method="post" >
                          @csrf <!-- This generates a CSRF token for protection against CSRF attacks -->
                          <button type="submit" class='btn btn-danger'>Logout</button>
                    </form></div>
              </div>

             
              

                </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
