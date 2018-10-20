<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\User;
use App\Address;
use App\Post;
use App\Photo;
use App\Staff;
use App\Tag;
use App\Video;
use App\Taggable;
use Carbon\Carbon;


Route::get('/', function () {
    return view('welcome');
});

// one-to-one relationship

Route::get('/insert', function(){
    $user = User::findOrFail(1);
    $address = new Address(['name'=>'2398 New York']);
    $user->address()->save($address);
});

Route::get('/update', function(){
    $address = Address::whereUserId(1)->first();
    $address->name = '2398 Florida';
    $address->save();
});

Route::get('/read', function(){
    $user = User::findOrFail(1);
    echo $user->address->name;
});

Route::get('/delete', function(){
   $user = User::findOrFail(1);
   $user->address()->delete();
   return "done";
});

// one-to-many relationship

Route::get('/create', function(){
    $user = User::findOrFail(1);
    $post = new Post(['title'=>'New Create Title3', 'body'=>'This is a create body3']);
    $user->posts()->save($post);
});

Route::get('/read', function(){
    $user = User::findOrFail(1);
    foreach($user->posts as $post){
        echo $post->title, '<br>';
    }
});

Route::get('/update', function(){
    $user = User::findOrFail(1);
    $user->posts()->where('id', '=', 1)->update(['title' =>"Updated Title", 'body'=> 'updated body']);
});

Route::get('/delete', function(){
    $user = User::findOrFail(1);
    $user->posts()->whereId(1)->delete();
});

// polymorphic one-to-one relationship

Route::get('/create/poly', function(){
    $staff = Staff::find(1);
    $staff->photos()->create(['path'=>'example.jpg']);
});

Route::get('/read/poly', function(){
    $staff = Staff::findOrFail(1);
    foreach($staff->photos as $photo){
        return $photo->path;
    }
});

Route::get('/update/poly', function(){
    $staff = Staff::findOrFail(1);
    $photos = $staff->photos()->whereId(1)->first();
    $photos->path = 'updatedExample2.jpg';
    $photos->save();
});

Route::get('/delete/poly', function(){
    $staff = Staff::findOrFail(1);
    $staff->photos()->whereId(1)->delete();
});

Route::get('/assign', function(){
    $staff = Staff::findOrFail(2);
    $photo = Photo::findOrFail(2);
    $staff->photos()->save($photo);
});

Route::get('/unassign', function(){
    $staff = Staff::findOrFail(2);
    $staff->photos()->whereId(2)->update(['imageable_id'=>'', 'imageable_type'=>'']);
});

// polymorphic many-to-many

Route::get('create/poly2', function(){
    $post = Post::create(['title'=>'My first post']);
    $tag1 = Tag::find(1);
    $post->tags()->save($tag1);
    
    $video = Video::create(['name'=>'firstVideo.mov']);
    $tag2 = Tag::find(2);
    $video->tags()->save($tag2);
    
});

Route::get('/read/poly2', function(){
    $post = Post::findOrFail(3);
    foreach($post->tags as $tag){
        echo $tag;
    }
});

Route::get('/update/poly2', function(){
    $video = Video::findOrFail(1);
    $tag = Tag::findOrFail(3);
    $video->tags()->save($tag);
});

Route::get('/delete/poly2', function(){
    $video = Video::findOrFail(1);
    foreach($video->tags as $tag){
        $tag->whereId(4)->delete();
    }
});

//
// Route::group(['middleware'=>'web'], function(){
//     Route::resource('/posts', 'PostsController');
// });

Route::resource('/posts', 'PostsController');

Route::get('/dates', function(){
    $date = new DateTime('+1 week');
    echo $date->format('m-d-Y');
});


// accessor
Route::get('/getname', function(){
    $user = User::findOrFail(1);
    echo $user->name;
});

// mutator
Route::get('/setname', function(){
    $user = User::findOrFail(1);
    $user->name="brent";
    $user->save();
});



Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/admin/user/roles', ['middleware'=>'role', function(){
    
    return "Middleware Role";
}]);

Route::get('/admin', 'AdminController@index');

Route::get('/mail', function(){
    $data = [
        'title' => 'This is a test title',
        'content' => 'This is a test content'
        ];
    Mail::send('mail.test', $data, function($message){
        $message->to('igibliss00@gmail.com', 'IGI')->subject('This is a test subject');
    });
});
