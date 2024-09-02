@extends('layouts.logout')

@section('content')
<div class="container">
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/login']) !!}

<p>AtlasSNSへようこそ</p>

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}
@if ($errors->has('mail'))
   <span class="text-danger">{{ $errors->first('mail') }}</span>
@endif
{{ Form::label('パスワード') }}
{{ Form::password('password',['class' => 'input']) }}
@if ($errors->has('password'))
   <span class="text-danger">{{ $errors->first('password') }}</span>
@endif

{{ Form::submit('ログイン', ['class' => 'btn']) }}

<ul><a href="/register">新規ユーザーの方はこちら</a></ul>

{!! Form::close() !!}
</div>

@endsection
