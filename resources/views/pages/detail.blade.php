@extends('app')

@section('head')
<?php $agent = new Jenssegers\Agent\Agent(); ?>
@if($agent->isMobile())
    <link rel="stylesheet" href="/css/DetailListStyle.mobile.css" />
@else
    <link rel="stylesheet" href="/css/DetailListStyle.css" />
@endif
    <link rel="stylesheet" href="/css/ListItemStyle.css" />
@stop

@section('content') 
    <ul>
        @foreach($items as $item)
            <li>
                <div onclick="location.href='{{$item->ID}}/{{$item->FileName}}'" class="CardViewItem mdl-card mdl-shadow--2dp" style="background: url({{$item->FileThumb}}) 0% 0% / 100% no-repeat;">
                    <div class="mdl-card__title mdl-card--expand"></div>
                    <div class="mdl-card__actions">
                        <span class="CardText">{{$item->FileName}}</span>
                        <span class="CardSubText">{{$item->ClickCount}} Views</span>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@stop
