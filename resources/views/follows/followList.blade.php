@extends('layouts.login')

@section('content')

<div class="following-list">
  <h2>フォローリスト</h2>
  <div style="
    display: flex;
    width: 80%;
    flex-wrap: wrap;">
    @foreach ($followingUsers as $user)
      <div class="following-item">
        <a href="{{ url('profile/' . $user->id) }}">
          <img src="{{ asset('images/' .$user->images) }}" alt="Icon">
        </a>
      </div>
    @endforeach
  </div>
</div>

<div id="posts-list">
  <table>
    <tbody>
      @foreach ($posts as $post)
        <tr>
          <!-- <td><img src="{{ asset('images/' .$user->images) }}" alt="Icon"></td>
          <td>{{ $post->user->username }}</td>
          <td>{{ $post->post }}</td>
          <td>{{ $post->created_at }}</td> -->

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