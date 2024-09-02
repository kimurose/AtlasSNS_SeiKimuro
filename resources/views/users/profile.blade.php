@extends('layouts.login')

@section('content')

<div class="edit-profile">
  <div class="profile-image">
    <img src="{{ asset('images/' . ($user->images ?? 'icon1.png')) }}" alt="" style="width: 50px; height: 50px;">
  </div>

  <div class="form-container">
  <form action='/profile/update' method="POST" enctype="multipart/form-data">
    @csrf

          <!-- エラーメッセージの表示 -->
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      

      <!-- ユーザー名 -->
      <div class="form-group">
        <label for="username">ユーザー名</label>
        <input type="text" name="username"  value="{{ old('username', $user->username) }}">
      </div>

      <div class="form-group">
        <label for="mail">メールアドレス</label>
        <input type="email" name="mail"  value="{{ old('mail', $user->mail) }}">
      </div>

      <div class="form-group">
        <label for="password">パスワード</label>
        <input type="password" name="password" >
      </div>

      <div class="form-group">
        <label for="password_confirmation">パスワード確認</label>
        <input type="password" name="password_confirmation" >
      </div>

      <!-- 自己紹介 -->
      <div class="form-group">
        <label for="bio">自己紹介</label>
        <input type="text" name="bio" id="bio" placeholder="任意" value="{{ old('bio', $user->bio) }}">

      </div>

      <div class="form-group">
        <div for="icon">アイコン画像</div>
        @if ($user->icon)
          <img src="{{ asset('storage/icons' . $user->icon) }}" alt="icon">
        @endif

        <div class="custom-file">
          <input type="file" name="images" id="images" class="custom-file-input">
          <label class="custom-file-label" for="images">ファイルを選択</label>
        </div>
      </div>

      <div class="submit-container">
      <input type="submit" value="更新" class="btn btn-primary">
      </div>
    </form>
    </div>
    
    
</div>
@endsection