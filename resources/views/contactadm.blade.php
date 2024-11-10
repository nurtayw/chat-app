@extends('layouts.admin')

@section('title', 'Users')

@section('content')
    <h1>Contacts </h1>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Messages</th>
        </tr>
        </thead>
        <tbody>
        @for($i=0; $i<count($contact); $i++)
            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$contact[$i]->name}}</td>
                <td>{{$contact[$i]->email}}</td>
                <td>{{$contact[$i]->message}}</td>
            </tr>
        @endfor
        </tbody>
    </table>
@endsection
