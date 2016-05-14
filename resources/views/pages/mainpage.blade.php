@extends('app')

@section('head')
    <link rel="stylesheet" href="/css/ListItemStyle.css" />
@stop

@section('header')
    @if (!isset($searchText))
        {!! $canBack = false; !!}
    @endif
    <div class="mdl-layout-spacer"></div>
    {!! Form::open(['method' => 'GET', 'style' => 'margin: 0 auto;', 'url' => 'search']) !!}  
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
                <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
                <input value="{{isset($searchText) ? $searchText : ''}}" class="mdl-textfield__input" id="search" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }" name="title" type="text">  
                </input>
                <label class="mdl-textfield__label" for="search-expandable">Search...</label>
            </div>
        </div>
    {!!  Form::close()  !!} 
    <button onclick="location.href='https://github.com/Tlaster/OneEchan'" class="mdl-button mdl-js-button mdl-button--icon">
        <i class="material-icons">get_app</i>
    </button>
    @if(Auth::check())
    <button onclick="location.href='/logout'" class="mdl-button mdl-js-button mdl-button--icon">
        <i class="material-icons">exit_to_app</i>
    </button>
    @else
    <button onclick="location.href='/login'" class="mdl-button mdl-js-button mdl-button--icon">
        <i class="material-icons">account_circle</i>
    </button>
    @endif
@stop

@section('content')
    <div id="data">
        @foreach($items as $item)
            <a href="{{$item->ID}}" class="ListItem mdl-button mdl-js-button mdl-js-ripple-effect">
                <span class="ListTitle">{{$item->Name}}</span>
                <span class="ListSubTitle">{{Date::parse($item->LastUpdate)->diffForHumans()}}</span>
            </a>
        @endforeach
    </div>
    <div style="margin: 0 auto;display: table;">   
        @if($items->previousPageUrl() != null)
        <button style="margin:8;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--icon" onclick="location.href='{{$items->url($items->currentPage()-1)}}'" >
            <i class="material-icons">arrow_back</i>
        </button>
        @endif
        @if($items->total() > 1)
        @for ($i = 1; $i <= $items->lastPage(); $i++)
            <button style="margin:8;" class="mdl-button mdl-js-button mdl-button--icon {{ ($items->currentPage() == $i) ? 'mdl-button--colored' : '' }}" onclick="location.href='{{$items->url($i)}}'" >{{$i}}</button>
        @endfor
        @endif
        @if(($items->currentPage() != $items->lastPage()) && ($items->total() > 0))
        <button style="margin:8;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--icon" onclick="location.href='{{$items->url($items->currentPage()+1)}}'">
            <i class="material-icons">arrow_forward</i>
        </button>
        @endif
    </div>
@stop
