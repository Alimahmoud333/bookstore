@extends('layouts.app')

@section('title', 'My Cart')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <livewire:user.cart-component />
        </div>
    </div>
@endsection
