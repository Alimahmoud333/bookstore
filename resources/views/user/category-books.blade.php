@extends('layouts.app')

@section('content')
    <livewire:user.category-books :category="request()->route('category')" />
@endsection
