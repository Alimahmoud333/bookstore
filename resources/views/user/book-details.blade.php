@extends('layouts.app')

@section('content')
    <livewire:user.book-details :book="request()->route('book')" />
@endsection
