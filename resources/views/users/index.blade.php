@extends('layouts.default')
@section('title','会员列表')
    @section('content')
        <table class="table table-bordered table-responsive" id="users">
            <tr>
                <th>ID</th>
                <th>会员名</th>
                <th>会员状态</th>
                <th>操作</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->status==-1?'违规,已禁用':'正常'}}</td>
                    <td>
                        <a href="{{ route('users.show',['user'=>$user]) }}" class="btn btn-primary btn-sm" >查看</a>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $users->links() }}
    @stop

