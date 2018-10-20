@extends('layouts.app')

@section('content')

    <form method='post' action="{{ route('posts.store') }}" enctype="multipart/form-data">
        {!!csrf_field()!!}
        <div>
            <input type="text" name="title" placeholder="Enter Title"/>
            <input type="submit" name='submit' value="Submit"/>            
            
        </div>
        <div>
            <input type="file" name="file" id="file">
            <input type="submit" value="Upload Image" name="submit">       
        </div>
    </form>
    
    @if(count($errors) > 0)
    
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
    
    @endif


@endsection

@section('footer')



