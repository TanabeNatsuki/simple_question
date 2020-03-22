@extends('layouts.app')

@section('content')
<div class="conts">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    ログイン済みです
</div>
@endsection
