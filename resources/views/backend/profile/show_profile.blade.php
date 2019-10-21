@extends('layouts.backend.master')
@section('content')
    <div class="row">
        @if(isset($showinfo))
        <aside class="profile-nav col-lg-3">
            <section class="panel">
                <div class="user-heading round">
                    <a href="#">
                        @if(isset($showinfo->profile_picture))
                            <img src="{{asset('project_files/profile_photo')}}/{{$showinfo->profile_picture}}" alt="{{$showinfo->name}}">
                        @else
                            <i class="fa fa-user"></i>
                        @endif

                    </a>
                    <h1>{{$showinfo->name}}</h1>
                    <p>{{$showinfo->email}}</p>
                    <p>{{$showinfo->phone}}</p>
                </div>

            </section>
        </aside>
        <aside class="profile-info col-lg-9">

            <section class="panel">
                <div class="bio-graph-heading">
                    Aliquam ac magna metus. Nam sed arcu non tellus fringilla fringilla ut vel ispum. Aliquam ac magna metus.
                </div>
                <div class="panel-body bio-graph-info">
                    <h1>Bio Graph</h1>
                    <div class="row">
                        <div class="bio-row">
                            <p><span>Name </span>: {{$showinfo->name}}</p>
                        </div>
                        <div class="bio-row">
                            <p><span>Phone </span>: {{$showinfo->phone}}</p>
                        </div>
                        <div class="bio-row">
                            <p><span>Email </span>: {{$showinfo->email}}</p>
                        </div>
                        <div class="bio-row">
                            <p><span>User Type </span>: {{$showinfo->type}}</p>
                        </div>
                        <div class="bio-row">
                            <p><span>Status </span>: {{$showinfo->status}}</p>
                        </div>

                        <div class="bio-row">
                            <p><span>NID</span>: {{$showinfo->nid}}</p>
                        </div>
                        <div class="bio-row">
                            <p><span>Passport </span>: {{$showinfo->passport}}</p>
                        </div>
                        <div class="bio-row">
                            <p><span>Birth Certificate</span>: {{$showinfo->birth_certificate}}</p>
                        </div>
                        <div class="bio-row">
                            <p><span>Address </span>: {{$showinfo->address}}</p>
                        </div>


                        <a class="btn btn-primary btn-lg pull-right" href="{{route('edit_profile',$showinfo->id)}}"><i class="fa fa-edit"></i>Edit</a>

                    </div>

                </div>
            </section>

        </aside>
            @else
            <h3>Profile Not Active...</h3>
            @endif
    </div>
@endsection