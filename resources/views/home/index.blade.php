@extends('layouts.admin')
@section('content')



@if(Auth::check())
    @include('includes/home/user-home')
@else
    @include('includes/home/guest-home')  
@endif    
@endsection

@section('view-styles')
<style>
    .pad20{padding:20px}
</style>
@endsection