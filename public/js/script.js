document.addEventListener('DOMContentLoaded', function() {
  var toggleMenu = document.getElementById('toggle-menu');
  var accordionMenu = document.getElementById('accordion-menu');

  if (toggleMenu) {
    toggleMenu.addEventListener('click', function() {
      if (accordionMenu.classList.contains('show')) {
        accordionMenu.classList.remove('show');
      } else {
        accordionMenu.classList.add('show');
      }
      if (toggleMenu.classList.contains('active')) {
        toggleMenu.classList.remove('active');
      } else {
        toggleMenu.classList.add('active');
      }
    });
  }
  document.addEventListener('click', function(event) {
    if (!accordionMenu.contains(event.target) && !toggleMenu.contains(event.target)) {
      accordionMenu.classList.remove('show');
    }
  });

  // post-buttonのクリックイベント
  var postButton = document.getElementById('post-button');
  postButton.addEventListener('click', function() {
    var postContent = document.getElementById('post-textarea').value;
    document.getElementById('post-content').value = postContent;
    document.getElementById('post-form').submit();
  });

  // // モーダル
  // document.addEventListener('DOMContentLoaded', function() {
  //   // モーダルを開く
  //   document.querySelectorAll('.js-modal-open').forEach(function(trigger){
  //     trigger.addEventListener('click', function(event) {
  //       event.preventDefault();
  //       const postContent = this.getAttribute('data-post');
  //       const postId =this.getAttribute('data-id');

  //       // モーダル内のフォームにデータをセット
  //       document.querySelector('.modal_post').value = postContent;
  //       document.querySelector('.modal_id').value = postId;

  //       // モーダルを表示
  //       document.querySelector('.js-modal').classList.add('is-active');
  //     });
  //   });

  //   // モーダルを閉じる
  //   document.querySelectorAll('.js-modal-close').forEach(function(close) {
  //     close.addEventListener('click', function() {
  //       document.querySelector('.js-modal').classList.remove('is-active');
  //     });
  //   });
  // });

  $(function(){
    // 編集ボタン(class="js-modal-open")が押されたら発火
    $('.js-modal-open').on('click',function(){
        // モーダルの中身(class="js-modal")の表示
        $('.js-modal').fadeIn();
        // // 押されたボタンから投稿内容を取得し変数へ格納
        // var post = $(this).attr('post');
        // // 押されたボタンから投稿のidを取得し変数へ格納（どの投稿を編集するか特定するのに必要な為）
        // var post_id = $(this).attr('post_id');

        // 投稿内容とIDを取得
        var post = $(this).data('post');
        var postId = $(this).data('id')

        // 取得した投稿内容をモーダルの中身へ渡す
        $('.modal_post').val(post);
        // 取得した投稿のidをモーダルの中身へ渡す
        $('.modal_id').val(postId);
        return false;
    });

    // 背景部分や閉じるボタン(js-modal-close)が押されたら発火
    $('.js-modal-close').on('click',function(){
        // モーダルの中身(class="js-modal")を非表示
        $('.js-modal').fadeOut();
        return false;
    });
});
});