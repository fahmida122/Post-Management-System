
@extends('layouts.index')

     @section('stylesheet')
<style>
    label{
        font-size:1.2rem;font-weight:600;margin-top:1rem
    }

    .ck-editor__editable p {
    max-height: 200px; /* Adjust the height as needed */
}

.ck-editor__editable  {
    display: block;
    color: black;
    font-weight: 600;
}


    </style>
     @endsection
 
   

     @section('main')
     
    <div class="container" style='margin-top:50px'>
    <div class="contact-form">
        <h2>Edit Post</h2>
        @if(Session('status')) 
        <p style="background: green;color:white;padding:1rem "> {{ Session('status') }} </p>
         @endif 
                <form action="{{route('blog.update', $editPost)}}" method="post" enctype="multipart/form-data">
                 @csrf @method('put')
                    <label for="title"><span>Title</span></label>
                    <input type="text" id="title" name="title"  class='form-control' value="{{ $editPost->title }}" />
                    @error('title')
                        {{-- The $attributeValue field is/must be $validationRule --}}
                        <p style="color: red; ">{{ $message }}</p>
                    @enderror
                    <!-- Image --> 
                    <label for="image"><span>Image</span></label>
                    <input type="file" id="image" name="image" class='form-control'/>
                    @error('image')
                        {{-- The $attributeValue field is/must be $validationRule --}}
                        <p style="color: red; ">{{ $message }}</p>
                    @enderror
                   
                  <!-- Drop down -->
                  <label for="categories"><span>Choose a category:</span></label>
                    <select name="category_id" id="categories" class='form-control'>
                    <option selected disabled>Select option </option> 
                        @foreach($ddCat as $dd)
                        <option value="{{$dd->id}}">{{$dd->name}}</option> 
                        @endforeach  
                    </select> 
                    @error('category_id')
                        {{-- The $attributeValue field is/must be $validationRule --}}
                        <p style="color: red; ">{{ $category_id }}</p>
                    @enderror
                   
                    <!-- Body-->
                    <label for="body"><span>Body</span></label>
                    @error('body')
                        {{-- The $attributeValue field is/must be $validationRule --}}
                        <p style="color: red; ">{{ $message }}</p>
                    @enderror
                    <textarea id="body" name="body" class='form-control' rows='6'>  {{ $editPost->body }} </textarea> 
                    <!-- Button -->
                    <input type="submit" value="Edit Post" class='btn btn-warning mt-3' />
                </form>
            </div>
    </div>
     
    @endsection




    @section('script')
     <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
     <script>
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
        </script> 
     @endsection