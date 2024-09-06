@extends('layouts.login')

@section('content')
<div id="posts-content">
  <div id="post">
  {!! Form::open(['url' => '/post/create','id'=>'posts-area']) !!}
   @if ($errors->has('post'))
    <div class="text-danger">
      @foreach ($errors->get('post') as $error)
       <p>{{ $error }}</p>
      @endforeach
    </div>
   @endif
    <img src="{{ asset('images/' . (Auth::user()->images ?? 'icon1.png')) }}" alt="Icon" id="icon">
    <textarea id="post-textarea" placeholder="投稿内容を入力してください" name="post"></textarea>
    <input type="image" src="{{ asset('images/post.png') }}" alt="Post" id="post-button">
  {!! Form::close() !!}
  </div>
  <div id="posts-list">
    <table>
      <tbody>
        @foreach ($posts as $post)
          <tr>
            <td class="post-info">
                <div class="post-header">
                  @if ($post->user_id == Auth::id())
                    <img src="{{ asset('images/' . Auth::user()->images) }}" alt="Icon">
                  @else
                    <img src="{{ asset('images/' . ($post->user->images ?? 'icon1.png')) }}" alt="Icon">
                  @endif
                  <span>{{ $post->user->username }}</span>
                  {{ $post->created_at }}
                </div>
                <div class="post-content">{!! nl2br(e($post->post)) !!}</div>
                <!-- 自分の投稿のみ削除ボタンを表示 -->
                @if ($post->user_id == Auth::id())
                <!-- 編集ボタン -->
                <!-- {--!! Form::open(['url' => '/post/' . $post->id . '/edit', 'method' => 'GET']) !!--}
                @csrf
                <input type="image" src="{{-- asset('images/edit.png') --}}">
                {--!! Form::close() !!--} -->
                <div class="post-actions">
                  <button class="js-modal-open edit-button" data-post="{{ $post->post }}" data-id="{{ $post->id }}" aria-label="Edit post">
                    <img src="{{ asset('images/edit.png') }}" alt="Edit">
                  </button>
                  <!-- <a class="js-modal-open" href="/post/update" data-post="{{-- $post->posst --}}" data-id="{{-- $post->id --}}"></a> -->
                  <!-- 削除ボタン -->
                  {!! Form::open(['url' => '/post/' . $post->id . '/delete', 'method' => 'delete', 'onsubmit' => 'return confirm("この投稿を削除します。よろしいですか？")']) !!}
                  @csrf
                  <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;" onmouseover="this.querySelector('img').src='{{ asset('images/trash-h.png') }}'" onmouseout="this.querySelector('img').src='{{ asset('images/trash.png') }}'">
                    <img src="{{ asset('images/trash.png') }}" alt="Delete">
                  </button>
                  {!! Form::close() !!}
                </div>
               @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- モーダルの記述 -->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    {!! Form::open(['url' => '/post/update', 'method' => 'POST']) !!}
    @csrf
    @if ($errors->has('post'))
     <div class="text-danger">
      @foreach ($errors->get('post') as $error)
       <p>{{ $error }}</p>
      @endforeach
     </div>
    @endif
    <textarea name="post" class="modal_post">{{ old('post') }}</textarea>
    <input type="hidden" name="id" class="modal_id" value="{{ $post->id }}">
    <button class="edit-button">
      <img src="{{ asset('images/edit.png') }}" alt="更新" class="edit-icon">
    </button>
    {!! Form::close() !!}
  </div>
</div>
@endsection