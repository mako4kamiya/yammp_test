
<header>
<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4"
      aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a href='/'class="navbar-brand nav-font">FE午後問題CBT体験</a>
    <div class="collapse navbar-collapse justify-content-end">
      <?php if (!preg_match('/cbt_test/', $_SERVER['REQUEST_URI'])) : ?>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href='/mypage.php' class="nav-link" href="#">マイページ</a>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link btn btn-link" data-bs-toggle="modal" data-bs-target="#logoutModal">ログアウト</button>
            <!-- ログアウトモーダル -->
            <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">ログアウトしますか？</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">戻る</button>
                    <a href="login.php?action=logout"><button type="button" class="btn btn-primary">ログアウトする</button></a>
                    
                  </div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      <?php endif ?>
    </div>
  </nav>

  </header>