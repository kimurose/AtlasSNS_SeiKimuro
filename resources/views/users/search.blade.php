@extends('layouts.login')

@section('content')

<div id="main-search-content">
  {!! Form::open(['url' => '/search', 'id'=>'search-area']) !!}
    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <!-- <img src="{{-- asset('images/search.png') --}}" alt="Icon" id="icon"> -->
    <input type="text" id="search-textarea" placeholder="ユーザー名" name="search">
    <input type="image" src="{{ asset('images/search.png') }}" alt="Search" id="search-button">
  {!! Form::close() !!}

  @if(isset($search))
    <div id="search-word">
      検索ワード: {{ $search }}
    </div>
  @endif
</div>

  @if(isset($users))
    <ul>
      @forelse($users as $user)
      <li class="search-list">
        <img src="{{ asset('images/'. ($user->images ?? 'icon1.png')) }}" alt="User Icon" class="user-icon">
        <span>{{ $user->username }}</span>
        @if($user->id !== Auth::id())
          @if(Auth::user()->following->contains($user->id))
          <!-- フォロー解除ボタン -->
          <form action="{{ url('unfollow') }}" method="POST">
            @csrf
            <input type="hidden" name="following_id" value="{{ $user->id }}">
            <button type="submit" class="unfollow-button">フォロー解除</button>
            <!-- <button class="unfollow-button">フォロー解除</button> -->
          </form>
          @else
          <!-- フォローボタン -->
          <form action="{{ url('follow') }}" method="POST">
            @csrf
            <input type="hidden" name="following_id" value="{{ $user->id }}">
            <button type="submit" class="follow-button">フォローする</button>
            <!-- <button class="follow-button">フォローする</button> -->
          </form>
          @endif
        @endif
      </li>
      @empty
      <li>該当するユーザーが見つかりませんでした。</li>
      @endforelse
    </ul>
  @endif




@endsection