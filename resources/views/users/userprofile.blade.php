@extends('layouts.login')

@section('content')

<div class="profile-info">
  <!-- 他のプロフィール情報もここに表示 -->
   <!-- <div id="posts-area"> -->
      @if ($user->id != Auth::id())
          <img src="{{asset('images/' . $user->images) }}" alt="" id="icon">
          <div class="profile-details">
            <div class="username-wrapper">
              <p class="profile-username">ユーザー名 </p>
              <p> {{ $user->username }}</p>
            </div>
            <div>
              <p>自己紹介 </p>
              <p class="profile-bio"> {{ $user->bio }}</p>
            </div>
          </div>
          <div class="follow-button-wrapper">
            @if (Auth::user()->following->contains($user->id))
              <!-- フォロー解除ボタン -->
              <form action="{{ url('unfollow') }}" method="POST">
              @csrf
              <input type="hidden" name="following_id" value="{{ $user->id }}">
              <button type="submit" class="unfollow-button">フォロー解除</button>
              </form>
            @else
            <!-- フォローボタン -->
              <form action="{{ url('follow') }}" method="POST">
              @csrf
              <input type="hidden" name="following_id" value="{{ $user->id }}">
              <button type="submit" class="follow-button">フォローする</button>
              </form>
            @endif
          </div>
      @endif
  <!-- </div> -->
</div>

<div id="posts-list">
  <table>
    <tbody>

        @foreach ($posts as $post)
          <tr>
            <td class="post-info">
              <div class="post-header">
                <img src="{{ asset('images/' .$post->user->images) }}" alt="Icon">
                <span>{{ $post->user->username }}</span>
                {{ $post->created_at }}
              </div>
              <div class="post-content">{!! nl2br(e($post->post)) !!}</div>
            </td>
          </tr>
        @endforeach
      
    </tbody>
</table>
</div>
  

  @endsection
  
