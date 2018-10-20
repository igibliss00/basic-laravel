@extends('layouts.app')

@section('content')

    <li>
        <a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a>
    </li>

@endsection

@section('footer')