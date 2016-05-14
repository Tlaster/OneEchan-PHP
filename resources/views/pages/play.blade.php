@extends('app')

@section('head')
<?php $agent = new Jenssegers\Agent\Agent(); ?>
@if($agent->isMobile())
    <link rel="stylesheet" href="/css/VideoStyle.mobile.css" />
@else
    <link rel="stylesheet" href="/css/VideoStyle.css" />
@endif
    <link rel="stylesheet" href="/css/ListItemStyle.css" />
@stop

@section('content')
    <video id="VideoElement" class="mdl-shadow--2dp" controls="controls" src="{{$item->FilePath}}"></video>
    <div class="centerdiv">
        <ul class="mdl-list">
            @foreach($comments as $comment)
            <li class="mdl-list__item mdl-list__item--three-line">
                <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-avatar">person</i>
                    <span>{{$comment->name}}</span>
                    <span class="mdl-list__item-text-body">
                        {{$comment->body}}
                        <br/>
                        {{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}
                    </span>
                </span>
            </li>
            @endforeach
        </ul>
        @if(Auth::check())
        {!! Form::open(['method' => 'POST', 'style' => 'margin: 0 auto;', 'url' => '#']) !!}  
            <div class="centerdiv mdl-textfield mdl-js-textfield">
                <textarea name="body" class="mdl-textfield__input" type="text" rows= "3" id="commentbody" ></textarea>
                <label class="mdl-textfield__label" for="commentbody">Write down your comment...</label>
            </div>
            <input value="post" type="submit" class="submitbutton mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect"></input>
        {!!  Form::close()  !!} 
        @endif 
    </div>
@stop