
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
     
    <div class="container col-md-8" style='margin-top:50px'>
   <div class="card">
    <div class="card-body">
    <div class="contact-form">
        <h2>Create Category</h2>
        @if(Session('status')) 
        <p style="background: green;color:white;padding:1rem "> {{ Session('status') }} </p>
         @endif
                 <form action="{{route('category.store')}}" method="post" >
                 @csrf
                    <label for="name"><span>Name</span></label>
                    <input type="text" id="name" name="name"  class='form-control' value="{{ old('name') }}" />
                    @error('name')
                        {{-- The $attributeValue field is/must be $validationRule --}}
                        <p style="color: red; ">{{ $message }}</p>
                    @enderror
                      
                    <input type="submit" value="Create" class='btn btn-primary mt-3' />
                </form>
                <a href="{{route('category.index')}}" class='btn btn-warning mt-5'>All Category</a>
            </div>
    </div>
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