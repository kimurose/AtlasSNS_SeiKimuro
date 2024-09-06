@extends('layouts.login')

@section('content')

  <div class="follower-list">
  <h2>フォロワーリスト</h2>
   <div style="
    display: flex;
    width: 75%;
    flex-wrap: wrap;">
    @if($followers->isEmpty())
      <p>フォロワーはいません。</p>
    @else
      @foreach ($followers as $user)
        <div class="follower-item">
          <a href="{{ url('/profile/' . $user->id) }}">
            <img src="{{ asset('images/' .$user->images) }}" alt="">
          </a>
        </div>
      @endforeach
    @endif
  </div>
  </div>

<div id="posts-list">
  <table>
    <tbody>
      @foreach ($posts as $post)
        <tr>
          <td class="post-info">
            <div class="post-header">
            <a href="{{ url('/profile/' . $post->user->id) }}">
              <img src="{{ asset('images/' .$post->user->images) }}" alt="Icon">
            </a>
              <span>{{ $post->user->username }}</span>
              {{ $post->created_at }}
            </div>
            <div class="post-content">{{ $post->post }}</div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection