<section id="t1">
    <h1>次の<strong>問 1</strong>は必須問題です。必ず解答してください。</h1>
    <h2><strong>問 1</strong>　テレワークの導入に関する次の記述を読んで，設問 1~3に答えよ。</h2>
    <p>
        　ソフトウェア開発会社である A社では，従業員が働き方 を柔軟に選択できるように，
        場所や時間の制約を受けずに働く勤務形態であるテレワークを遅入することにした。
    </p>
    <p>
        　A社には，事務業務だけが行える PC(以下，事務 PCという）と，
        事務業務及びソフトウェア開発業務が行える PC(以下，開発 PCという）がある。
        開発部の従業員は開発 PCを使用し，開発部以外の従業員は事務 PCを使用している。
    </p>
    <p>　A社には事務室，開発室及びサーバ室があリ ，
        各部屋のネットワーク はファイアウォール（以下， A社 FWという）を介して接続されている。
        A社のネットワーク構成を 図 1に示す。
    </p>
    <figure>
        <img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t1_1.png" alt="図 1 A社のネットワ ーク構成">
        <figcaption>図 1 A社のネットワ ーク構成</figcaption>
    </figure>
    <p>
        　事務室には，事務 PCだけが設置されている。
        開発室には開発 PCだけが設置されておリ，開発部の従業員だけが入退室できる。
        サーバ室には，プロキシサーバ 1台と，ソフトウェア開発業務に必要なソースコード管理，
        バグ管理，テストなどに利用するサーバ（以下，開発サーバという）が複数台設置されている。
    </p>
    <p>
        　A社 FWでは，開発室のネットワークだけから開発サーバに HTTPover TLS (以下， HTTPSという）
        又は SSHでアクセスできるように通信を制限している。
        また，A社ネットワークからのインターネットの Webサイト閲覧は，
        事務 PC及び開発 PCだけからプロキシサーバを経由してできるように通信を制限している。
    </p>
    <br>
    <p>
        　テレワークで働く従業員は，データを保存できないシンクライアント端末を A 社から支給され，
        遠隔からインターネットを経由して A社のネットワークに接続し，業務を行う。
        そのために，安全に A社のネットワークに接続する VPN, 及び仮想マシンの画面を転送して
        遠隔から操作できるようにする画面転送型の仮想デスクトップ環境（以下， VDIという）の尊入を検討した。
        テレワーク導入後の A社のネットワーク構成案を，図 2に示す。
    </p>
    <figure>
        <img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t1_2.png" alt="図 2 テレワーク 導入後の A社のネットワーク構成案">
        <figcaption>図 2 テレワーク 導入後の A社のネットワーク構成案</figcaption>
    </figure>
    <p>(A社が検討したテレワークによる業務の開始までの流れ〕</p>
    <ol>
        <li>(1)　利用者は，シンクライアント端末の VPNクライアントを起動して， VPNサーバに接続する。</li>
        <li>(2)　VPNサーバは， VPNクライアントが提示するクライアント証明書を検証する。検証に成功した場合，処理を継続する。</li>
        <li>(3)　VPNサーバは，利用者を認証する。認証が成功した場合， VPNクライアントに対して， 192.168.16.Q/24の範囲で使用されていない IPアドレスを 一つ選択して割リ当てる。</li>
        <li>(4)　VPNクライアントは， (3)で割り当てられた IPアドレスを使用して， VPNサーバ経由で A社のネットワークに接続する。</li>
        <li>(5)　利用者は，シンクライアント端末の VDIクライアントを起動して， VDIサーバに接続する。</li>
        <li>(6)　VDIサーバは， VPNサーバで認証された利用者が開発部以外の従業員であれば事務業務だけが行える仮想マシン（以下，事務 V Mという）を，開発部の従業員であれば事務業務及びソフトウェア開発業務が行える仮想マシン（以下，開発 VMという）を割リ 当てる。また， VDIサーバは，事務 VMには 192.168.64.0/24,開発V Mには 192.168.65.0/24の範囲で使用されていない IPアドレスを 一つ選択して割リ当てる。</li>
        <li>(7)　利用者は，仮想マシンにログインして業務を開始する。 VDIクライアントと仮想マシンとの間では，画面データ，並びにキーボード及びマウスの操作データだけが送受信される。</li>
    </ol>
    <br>
    <p>　テレワーク導入後の A社 FWに設定するパケットフィルタリングのルール案を，表 1に示す</p>
    <figure>
        <figcaption>表 1 A社 FWに設定するパケットフィルタリングのルール案</figcaption>
        <img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t1_3.png" alt="表 1 A社 FWに設定するパケットフィルタリングのルール案">
    </figure>
    <p>
        　ところが，表 1のルール案ではルール番号 7の条件に誤リがあリ，<span>a</span>ことが分かった。
        そこで，開発サーバに対するアクセスを正しく制限するために，ルール番号 の条件について,送信元を<span>b</span>に変更した。
    </p>
    <article>
        <h2><strong>設問 1</strong>　本文中の<span></span>に入れる適切な答えを，解答群の中から選べ。</h2>
        <ul>
            <h3>aに関する解答群</h3>
            <li>ア　開発 PCから開発サーバにアクセスできない</li>
            <li>イ　開発 VMから開発サーバにアクセスできない</li>
            <li>ウ　事務 PCから開発サーバにアクセスできる</li>
            <li>エ　事務 VMから開発サーバにアクセスできる</li>
        </ul>
        <ul class="row">
            <h3>bに関する解答群</h3>
            <li class="col-4">ア　192.168.0.0/24</li>
            <li class="col-4">イ　192.168.1.0/24</li>
            <li class="col-4">ウ　192.168.16.0/24</li>
            <li class="col-4">エ　192.168.64.0/24</li>
            <li class="col-4">オ　192.168.65.0/24</li>
            <li class="col-4">カ　192.168.128.0/20</li>
            <li class="col-4">キ　192.168.128.0/24</li>
            <li class="col-4">ク　203.0.113.0/24</li>
            <li class="col-4">ケ　インターネット</li>
        </ul>
    </article>
    <article>
        <h2><strong>設問 2</strong>　シンクライアント端末から開発サーバにアクセスするときの接続経路として適切な答えを，解答群の中から選べ。</h2>
        <ul>
            <h3>解答群</h3>
            <li>ア　シンクライアント端末 → VDIサーバ→ VPNサーバ→開発 PC→ 開発サーバ</li>
            <li>イ　シンクライアント端末→ VDIサーバ→ VPNサーバ→ 開発 VM→ 開発サーバ</li>
            <li>ウ　シンクライアント端末→ VDIサーバ→開発 VM→ 開 発 PC→ 開発サーバ</li>
            <li>エ　シンクライアント端末→ VPNサーバ→ VDIサーバ→ 開発 PC→ 開発サーバ</li>
            <li>オ　シンクライアント端末→ VPNサーバ → VDIサーバ→ 開発 VM→ 開発サーバ</li>
            <li>カ　シンクライアント端末→ VPNサーバ→ 開発 PC→ 開発 VM→ 開発サーバ</li>
        </ul>
    </article>
    <article>
        <h2>
            <strong>設問 3</strong>
            　A社がテレワークの検討を進める過程で， ‘‘常に同一の業務環境を使用できるように，
            テレワークで働くときだけでなく，事務 PC及び開発 PCからも仮想マシンを使用したい＂との要望が挙がった。
            検討した結果 ，この要望に応えてもセキュリティ上のリスクは変わらないと判断した。
            また， A社のネットワーク内からアクセスするので VPNで接続する必要はなく，利用者認証を VPNサーバではなく
            VDIサーバで行えばよいことを確認した。この要望に応えるとき，表 1のルール案に必要な変更として適切な答えを
            解答群の中から選べ。ここで，表 1のルール番号 7の送信元には，設問 1で選択した適切な答えが設定されているものとする。
        </h2>
        <ul>
            <h3>解答群</h3>
            <li>ア　変更する必要はない。</li>
            <li>イ　ルール番号 3と 4の間に，送信元を 192.168.0.0/23, 宛先を 192.168.64.0/20,サー ビスを VDI, 及び動作を許可とするルールを新たに挿入する必要がある。</li>
            <li>ウ　ルール番号 3と 4の間に，送信元を 192.168.64.0/23, 宛先を 192.168.0.0/23,サービスを VDI, 及び動作を許可とするルールを新たに挿入する必要がある。</li>
            <li>エ　ルール番号 3と 4の間に，送信元をインタ・ーネット，宛先を 192.168.64.0/20,サービスを VDI, 及び動作を許可とするルールを新たに挿入する必要がある。</li>
        </ul>
    </article>
</section>