@extends('layouts.app')

@section('content')
    <div class="col-lg-8">
        <form action="{{route('create-user')}}" class="bg-light px-5  pt-lg-4 contact-form" method="POST">
            {{csrf_field()}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('message'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{session()->get('message')}}</strong>
                </div>
            @endif
            <h1 class="pb-5">Add User</h1>
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="Enter email" value="{{old('email')}}">
            </div>
            <div class="form-group">
                <textarea name="description" id="" cols="30" rows="7" class="form-control" placeholder="Add a brief description">{{old('description')}}</textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Add" class="btn btn-primary py-3 px-5">
            </div>
        </form>
    </div>
@endsection
