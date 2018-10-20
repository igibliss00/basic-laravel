@extends('layouts.app')

@section('content')

    <form method='post' action="/posts/{{$post->id}}">
        {{ csrf_field() }} 
        <input type="hidden" name="_method" value="PUT"> 
        <input type="text" name="title" placeholder="Enter Title" value="{{$post->title}}" />
        <input type="submit" name='submit' value="update"/>
    </form>
    
    <form method='post' action='/posts/{{$post->id}}'>
        {{ csrf_field() }} 
        <input type="hidden" name="_method" value="DELETE">
        <input type="submit" value="DELETE">
    </form>


@endsection

@section('footer')