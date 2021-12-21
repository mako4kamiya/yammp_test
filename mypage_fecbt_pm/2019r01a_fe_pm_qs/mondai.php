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
            <li class="col-3">ア　192.168.0.0/24</li>
            <li class="col-3">イ　192.168.1.0/24</li>
            <li class="col-3">ウ　192.168.16.0/24</li>
            <li class="col-3">エ　192.168.64.0/24</li>
            <li class="col-3">オ　192.168.65.0/24</li>
            <li class="col-3">カ　192.168.128.0/20</li>
            <li class="col-3">キ　192.168.128.0/24</li>
            <li class="col-3">ク　203.0.113.0/24</li>
            <li class="col-3">ケ　インターネット</li>
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

<section id="t2">
    <h1>　次の問 2から 問 7までの 6問については，この中から 4問を選択し，選択した問題については，「この問題を選択する」にチェックを入れてください。</h1>
    <h2><strong>問 2</strong>　スレッドを使用した並列実行に関する次の記述を読んで，設問 1~3に答えよ。</h2>
    <p>
        　プログラム中の並列実行が可能な部分を取り出し，その部分を分割して複数のスレッドで並列に実行する方法
        （以下，スレッド並列法という）がある。マルチプロセッサシステムでは，スレッド並列法を適用することによって，
        プログラムの実行時間を短縮できることがある。
    </p>
    <br>
    <p>
        　プログラムにおいて，スレッド並列法を適用しないで実行したときの実行時間を，
        スレッド並列法を適用したときの実行時間で割った値を，プログラム実行時間の高速化率という。
    </p>
    <p>
        　プログラムをスレッド並列法を適用しないで実行したときの，プログラム全体の実行時間に対する ，
        並列実行可能な部分の実行時間の割合を r(0≦r≦1) とする 。スレッドの個数を n (n≦1) にして，
        プログラムにスレッド並列法を適用すると、マルチプロセッサシステムでは，プログラム実行時間の高速化率 E は，
        次の式で求められる。ここで，各スレッドはそれぞれ異なるプロセッサに割リ当てられるものとし ，
        プログラムの実行に使用する全てのプロセッサの性能は同じとする。
    </p>
    <figure>
        <img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t2_1.png" class="col-4">
    </figure>
    <p>
        <br>
        　この式は，並列実行可能な部分のプログラム実行時間がスレッド並列法の適用によって 1/n になリ，
        その他の部分のプログラム実行時間は変化しないときの高速化率を 計算するものである。
    </p>
    <br>
    <p>
        　プログラム中に並列実行が可能な部分をもつプログラム A に対して
        スレッドの個数を 2にしてスレッド並列法を適用すると， 高速化率は 3/2 になった。
        この場合，rは<span>a</span>である。
    </p>
    <br>
    <p>
        　rが3/4であるプログラムＢの場合、スレッドの個数を増やしても、高速化率の上限は<span>b</span>である。
    </p>
    <article>
        <h2><strong>設問 1</strong>本文中の<span></span>に入れる正しい答えを，解答群の中から選べ。</h2>
        <ul class="row">
            <h3>aに関する解答群</h3>
            <li class="col">ア　1/6</li>
            <li class="col">イ　1/4</li>
            <li class="col">ウ　1/3</li>
            <li class="col">エ　1/2</li>
            <li class="col">オ　2/3</li>
        </ul>
        <ul class="row">
            <h3>bに関する解答群</h3>
            <li class="col">ア　2</li>
            <li class="col">イ　3</li>
            <li class="col">ウ　4</li>
            <li class="col">エ　6</li>
            <li class="col">オ　8</li>
        </ul>
    </article>
    <article>
        <h2><strong>設問 2</strong>次の記述中の<span></span>に入る正しい答えを、解答群の中から選べ。</h2>
        <p>
            　配列の操作を行う繰返しの処理において，図 1 図 2のように繰返しの範囲を分割して，
            スレッド並列法を適用することを考える。
            　このとき，操作の内容によって，正しい結果が得られる場合と得られない場合があるので ，
            十分に検討することが必要である。
        </p>
        <br>
        <p>
            　正しい結果が得られる場合の例を，図 1に示す。
            　図 1に示すプログラム 1は，制御変数 iの取る範囲を分けることによって繰返し範囲を分割した繰返しの処理を ，
            それぞれ異なるスレッドで実行できる。
            　なお，図 1, 図 2において，実線の四角はプログラム，破線の四角は繰返しの処理、
            破線の四角から出る二つの矢印は分割を示す。
        </p>
        <figure>
            <img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t2_2.png" alt="図1 正しい結果が得られる場合の例" class="col-8">
        </figure>
        <p>
            　正しい結果が得られない場合の二つの例を， 図 2に示す。
            　プログラム 2の繰返しの処理を， スレッド 2-1とスレッド 2-2の二つに分割すると、
            <span>c</span>ことがあるので， スレッド並列法を適用しない場合の実行結果と等しくなることを保証できない。
            したがって， プログラム 2に対しては，繰返しの範囲の分割によるスレッド並列法を適用できない。
            　また， プログラム3の繰返しの処理を， スレッド3-1とスレッド3-2の二つに分割すると、
            <span>d</span>ことがあるので，スレッド並列法を適用しない場合のの実行結果と等しくなることを保証できない。
            したがって ，プログラム 3に対しても，繰返しの範囲の分割によるスレッド並列法を適用できない。
        </p>
        <figure>
            <img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t2_3.png" alt="図2 正しい結果が得られない場合二つの例">
        </figure>
        <ul>
            <h3>cに関する解答群</h3>
            <li>ア　a[51]の値をスレッド 2-1で更新するより先にスレッド 2-2で更新する</li>
            <li>イ　a[51]の値をスレッド 2-1で更新するよリ先にスレッド 2-2で参照する</li>
            <li>ウ　a[51]の値をスレッド 2-1で参照するよリ先にスレッド 2-2で更新する</li>
            <li>工　a[51]の値をスレッド 2-1で参照するよリ先にスレッド 2-2で参照する</li>
        </ul>
        <ul>
            <h3>dに関する解答群</h3>
            <li>ア　a[51]の値をスレッド 3-1で更新するよリ先にスレッド 3-2で更新する</li>
            <li>イ　a[51]の値をスレッド 3-1で更新するより先にスレッド 3-2で参照する</li>
            <li>ウ　a[51]の値をスレッド 3-1で参照するよリ先にスレッド 3-2で更新する</li>
            <li>エ　a[51]の値をスレッド 3-1で参照するより先にスレッド 3-2で参照する</li>
        </ul>
    </article>
    <article>
        <h2><strong>設問 3</strong>
            図 3に示すプログラム 4では， 配 列 aにおける更新対象の位置を配列ipの要素の値で指している。 
            このプログラムでは， 配 列 ip の要素の値によって， スレッド並列法を適用できる場合とできない場合がある。
            　図 4に示す配列 ipであれば，スレッド並列法を適用できる。図 4 中の<span></span>に入れる正しい答えを，解答群の中から選べ。
            　なお，図 3において，実線の四角はプログラム，破線の四角は繰返しの処理，破線の四角から出る二つの矢印は分割を示す。
        </h2>
        <figure>
            <img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t2_4.png" alt="図 3 プログラム 4 へのスレッド並列法の適用" class="col-8">
        </figure>
        <br>
        <img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t2_5.png" alt="図 4 スレッド並列法を適用できる配列ip" class="col-6">
        <ul  class="row">
            <h3>eに関する解答群</h3>
            <li class="col">
                ア　
                <table class="t2">
                    <tbody>
                        <td>1</td>
                        <td>2</td>
                        <td>8</td>
                        <td>9</td>
                        <td>10</td>
                    </tbody>
                </table>
            </li>
            <li class="col">
                イ　
                <table class="t2">
                    <tbody>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>
                        <td>9</td>
                    </tbody>
                </table>
            </li>
            <li class="col">
                ウ　
                <table class="t2">
                    <tbody>
                        <td>6</td>
                        <td>7</td>
                        <td>4</td>
                        <td>9</td>
                        <td>10</td>
                    </tbody>
                </table>
            </li>
            <li class="col">
                エ　
                <table class="t2">
                    <tbody>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>
                        <td>9</td>
                        <td>10</td>
                    </tbody>
                </table>
            </li>
        </ul>
    </article>
</section>

<section id="t3">
    <h1>選択した問題については，「この問題を選択する」にチェックを入れてください。</h1>
    <h2><strong>問 3</strong>　書籍及び貸出情報を管理する関係データベースの設計及び運用に関する次の記述を読んで，設問 1~3に答えよ。</h2>
    <br>
    <p>
        　D社の部署である資料室は，業務に関連する書籍を所蔵しておリ，従業員への貸出しを 2015年 4月から実施している。
        　所蔵する書籍を管理するデータベースは，書籍の情報を管理する苫籍情報表と貸出状況を管理する貸出表とで構成されている。
        データベース構成を，図 1に示す。下線付きの項目は主キーを表し ，下破線付きの項目は外部キーを表す。
        各書籍は 1冊しか所蔵していない。
    </p>
    <figure>
        <img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t3_1.png" alt="図 1 データベース構成">
        <figcaption>図 1 データベース構成</figcaption>
    </figure>
    <p>〔貸出表に関する説明〕</p>
    <ol>
        <li>(1)　従業員に書籍を貸し出す際は， 一意の貸出番号，貸し出す書籍の ISBNコード，従業員番号，
            貸出日及び返却予定日を設定し，返却日には NULLを設定したレコードを追加する。
        </li>
        <li>(2)　書籍が返却されたら，対象のレコードの返却日に返却された日付を設定する。</li>
    </ol>
    <article>
        <h2><strong>設問 1</strong>
        　次の SQL文は， ISBNコードが ISBN978-4-905318-63-7の書籍の貸出し状態を表示する SQL文である。 
        ISBNコードで貸出表を検索し，最も新しい貸出日のレコ ー ドの返却日に NULLが設定されている場合は，
        ”貸出中”が表示される。また，最も新しい貸出日のレコードの返却日に日付が設定されている場合，
        及び貸出実績のない書籍の場合は，”貸出可”が表示される。<span></span>に入れる正しい答えを，
        解答群の中から選べ。 ここで，検索に使用する ISBNコード の書籍は必ず所蔵されているものとする。
        また，返却された書籍はその日のうちに再び貸し出されることはない。
        </h2>
        <figure>
            <img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t3_2.png" alt="">
        </figure>
        <ul>
            <h3>aに関する解答群</h3>
            <li>
                ア　貸出表.返却日 IS NOT NULL THEN '貸出中' ELSE '貸出可'
            </li>
            <li>
                イ　貸出表.返却日 IS NOT NULL THEN '貸出中' <br>
                    　WHEN 貸出表.返却日 IS NULL THEN '貸出可'
            </li>
            <li>
                ウ　貸出表.返却日 IS NULL THEN '貸出可' ELSE '貸出中'
            </li>
            <li>
                エ　貸出表.返却日 IS NULL THEN '貸出中' <br>
                    　WHEN 貸出表.返却日 IS NOT NULL THEN '貸出可'
            </li>
        </ul>
        <ul>
            <h3>bに関する解答群</h3>
            <li>ア　DISTINCT 貸出表.貸出日</li>
            <li>イ　MAX(貸出表.貸出日）</li>
            <li>ウ　MIN(貸出表.貸出日）</li>
            <li>エ　貸出表.貸出日</li>
        </ul>
    </article>
    <article>
        <h2><strong>設問 2</strong>
            　2018年 4月 1日から 2019年 3月 31日までの間に 4回以上貸し出した書籍の一覧を取得することにした。
            次の SQL文のI Iに入れる正しい答えを，解答群の中から選べ。
        </h2>
        <figure>
            <img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t3_3.png" alt="">
        </figure>
        <ul>
            <h3>cに関する解答群</h3>
            <li>ア　<img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t3_4.png" style="display: inline"></li>
            <li>イ　<img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t3_5.png" style="display: inline"></li>
            <li>ウ　<img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t3_6.png" style="display: inline"></li>
            <li>エ　<img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t3_7.png" style="display: inline"></li>
        </ul>
    </article>
    <article>
        <h2><strong>設問 3</strong>
            　従業員と資料室担当者の利便性を向上させる目的で，所蔵する書籍を管理するデータベースを再構築することにした。
            　データベースの再構築に当たリ，従業員と資料室担当者から要望が出された。
            次の記述中の<span></span>に入れる適切な答えを，解答群の中から選べ。
        </h2>
        <p>〔従業員と資料室担当者からの要望〕</p>
        <ul>
            <li class="indent3">要望 1 ISBNコードが同じ書籍を複数冊所蔵できるようにしたい。</li>
            <li class="indent3">要望 2 書籍の購入日を管理できるようにしたい。</li>
            <li class="indent3">要望 3 ISBNコードごとに所蔵する書籍数及び貸出し中の書籍数（以下，貸出中件数という）が分かるようにしたい。</li>
            <li class="indent3">要望 4 ISBNコードが同じ書籍は同じラックに保管して，書籍が収納されているラックが分かるようにしたい。</li>
        </ul>
        <br>
        <p>
            　従業員と資料室担当者からの要望を反映したデータベース構成案を，図 2に示す。
            下線付きの項目は主キーを表し，下破線付きの項目は外部キーを表す。
        </p>
        <figure>
            <img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t3_8.png" alt="図 2 要望を反映したデータベース構成案" class="col-10">
            <figcaption>図 2 要望を反映したデータベース構成案</figcaption>
        </figure>
        <p>（要望に対するデータベース修正内容〕</p>
        <ul>
            <li class="indent3">修正 1 要望 1に対応するために書籍表を追加して，資料室で所蔵している各書籍に一意の書籍番号を割り振って，
                それを主キーとした。また，貸出表の ISBNコードを書籍番号に変更 した
            </li>
            <li class="indent3">修正 2 要望 2に対応するために書籍表に購入 日を設けた</li>
            <li class="indent3">修正 3 要望 3に対応するために書籍管理ビューを追加した。</li>
            <li class="indent3">修正 4 要望 4に対応するためにラック表を追加して，沓籍情報表に外部キーとしてラック番号を追加した。</li>
        </ul>
        <p>
            　要望を反映したデータベース構成案では，既に所蔵している書籍と ISBNコードが同じ書籍を追加購入した場合に，
            レコードを追加する必要のある表は<span>d</span>である。<br>
            　また，需要がなくなった書籍を廃棄する場合は，ISBNコードが同じ書籍を全て廃棄する。
            データベースに対して行う操作は，次の①～④を<span>e</span>の順序で行う必要がある。
        </p>
        <ul>
            <li>①　書籍情報表の主キーが対象 ISBNコードのレコードを削除する。</li>
            <li>②　書籍表から対象 ISBNコードに対応する 書籍番号を抽出する。</li>
            <li>③　書籍表の対象 ISBNコードに対応するレコードを削除する。</li>
            <li>④　貸出表の対象書籍番号に対応するレコードを削除する。</li>
        </ul>
        <ul>
            <h3>dに関する解答群</h3>
            <li class="col-5">ア　書籍表</li>
            <li class="col-5">イ　書籍表及びラック表</li>
            <li class="col-5">ウ　書籍情報表及び書籍表</li>
            <li class="col-5">工　書籍情報表，書籍表及びラック表</li>
        </ul>
        <ul>
            <h3>eに関する解答群</h3>
            <li>ア　②→①→③→④</li>
            <li>イ　②→①→④→③</li>
            <li>ウ　②→③→①→④</li>
            <li>エ　②→③→④→①</li>
            <li>オ　②→④→①→③</li>
            <li>力　②→④→③→①</li>
        </ul>
    </article>
</section>

<section id="t4">
    <h1>選択した問題については，「この問題を選択する」にチェックを入れてください。</h1>
    <h2><strong>問 4</strong>　NATに関する次の記述を読んで，設問 L 2に答えよ</h2>
    <p>
        　IPv4の IPアドレスのうち， 全世界で重複しないように管理されているグローバルIPアドレスはインターネットヘの接続に利用でき，
        プライベート IPアドレスは社内LANなどの閉じたネットワークだけで利用できる。
    </p>
    <p>
        　プライベート IPアド レスだけが割リ当てられている機器（以下，LAN内機器とい
        う）とインターネットに接続されている外部の機器（以下，インターネット機器とい
        う）とは直接通信することはできないが，例えば， NAT (Network Address
        Translation) を使うことによって通信することができるようになる。
    </p>
    <p>
        　本問で扱う NATは， NAPT(Network Address Port Translation)とも呼ばれる，ル
        ータが搭載している機能であリ，通過するパケットの IPアドレス及びポート番号を
        書き換えることによって， LAN内機器とインターネット機器との通信を可能にする。
        表1に， LAN内機器とインターネット機器との通信の際にルータを通過するパケッ
        トの， IPアドレス及びポート番号の書換えの概要を示す。ここで，送信パケ ットと
        は LAN内機器がインターネット機器に向けて送信するパケットのことをいい，受信
        パケットとはルータがインターネット機器から受信するパケットのことをいう 。
    </p>
    <figure>
        <img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t4_1.png" alt="表 1 IPアドレス及びポート番号の書換えの概要">
    </figure>
    <p>　NATには，静的 NATと動的 NATがある</p>
    <p>
        　静的 NATでは，ルータのグローバル IPアドレス及びルータのポート番号の組みと
        LAN内機器の IPアドレス及び LAN内機器のポー ト番号の組みとの対応をあらかじ
        め定義しておき，その定義に基づいて ，送信パケットと受信バケットの書換え対象の
        IPアドレス及びポート番号を書き換える。
    </p>
    <p>
        　動的 NATでは，送信パケットと受信パケットの書換え対象の IPアドレス及びポー
        ト番号を，次のように書き換える。
    </p>
    <ol style="list-style-type: decimal">
        <li>送信パケットの送信元 IPアドレス及び送信元ポート番号の書換え
            <ul>
                <li>
                    ① 送信パケットの送信元 IPアドレス及び送信元ポート番号の，書換え前の組み
                    (LAN内機器の IPア ドレス及び LAN内機器のポート番号の組み）と書換え後
                    の組み（ルータのグローバル IPアドレス及びルータのポート番号の組み）とを，
                    関連付けて 一定期間記憶する。
                </li>
                <li>
                    ② 送信パケットの送信元 IPアドレス及び送信元ポート番号の組みを，書換え前
                    の組みとして記憶している間は，関連付けられている書換え後の組みに書き換え
                    る
                </li>
                <li>
                    ③ 送信パケットの送信元 IPアドレス及び送信元ポート番号の組みを，書換え前
                    の組みとして記憶していないときは，ルータに割リ当てられている幾つかのグロ
                    ーバル IPアドレスのうちの一つと ，その IPアドレスで使用されていないポート
                    番号のうちの一つとの組みに書き換える。
                </li>
            </ul>
        </li>
        <li>受信パケットの宛先 IPアドレス及び宛先ポート番号の酋換え
            <ul>
                <li>
                    ① 受信パケッ トの宛先 IPアドレスと宛先ポート番号の組みが， 上記 1,① の書換
                    え後の組みとして記憶されている間は，関連付けられている書換え前の組みに書
                    き換える。
                </li>
            </ul>
        </li>
    </ol>
    <article>
        <h2>
            <strong>設問 1</strong>
            　次の (1)~ (3)のケースのうち，静的 NATよリも動的 NATの方が適 している
            ものを ，解答群の中から選べ。
        </h2>
        <ol style="list-style-type: decimal">
            <li>
                (1)　インターネット機器からアクセス可能なサーバを ，LAN内機器として設置する。
            </li>
            <li>
                (2)　 LAN内機器から ，インターネット機器にアクセスする。
            </li>
            <li>
                (3)　インタ ーネットを介する異なる LANの LAN内機器同士が，あらかじめ決
                まった固定のポートを使い，相互に通信する。
            </li>
        </ol>
        <ul>
            <h3>解答群</h3>
            <li>ア　(1)だけ</li>
            <li>イ　(1)と(2)</li>
            <li>ウ　(1)と(3)</li>
            <li>エ　(2)だけ</li>
            <li>オ　(2)と(3)</li>
            <li>カ　(3)だけ</li>
        </ul>
    </article>
    <article>
        <h2>
            <strong>設問 2</strong>
            　次の記述中の<span></span>に入れる正しい答えを、解答群の中から選べ。こ
            こで， al~a3に入れる答えは， aに関する解答群の中から組合せとして正 し
            いものを選ぶものとする。
        </h2>
        <br>
        <p>
            　IPv6と IPv4とは互換性がないので，IPv6のネットワーク内の機器（以下，
            IPv6機器という）と IPv4のネットワーク内の機器（以下， IPv4機器という）
            とは直接通信することができない。 IPv6機器から IPv4機器にアクセスする方
            法の一つ に， NATの機能を拡張した NAT64と， DNSの機能を拡張した
            DNS64との組合せによる方法がある。この方法による IPv6機器から IPv4機
            器へのアクセスの流れを次に示す。
        </p>
        <ul>
            <li>
                (1)　IPv6機器は，アクセス先の機器の IPアドレスを， DNS64から入手する。
                DNS64<span>a1</span>のネットワークに置かれる DNSであリ，ホスト名
                に対応する IPアドレスの問合せに対し ，対応する<span>a2</span>アドレスがあ
                ればそれを返し，対応する<span>a2</span>アドレスなく、<span>a3</span>アドレ
                スがあればそれを<span>a2</span>アドレスに変換して返す。ここで， IPv4アド
                レスの IPv6アドレス表現は，当該 IPv4アドレスを示す 4バイトの前に，あ
                らかじめ決められた 12バイトのプレフィクスを付加したものである。
            </li>
            <li>
                　IPv6機器は，入手した IPアドレスに宛てて IPv6のパケットを送信する。
            </li>
            <li>
                　(2)のパケットが IPv4機器向けならば， 当該パケットとその返信パケット
                は， NAT64の機能をもつルータ（以下， NAT64ルータという）が受信する。
            </li>
            <li>
                　(4) NAT64ルータは，IPv6機器から IPv4機器に向けて送信された IPv6のパ
                ケットを IPv4のパケットに ，その返信パケットである IPv4のパケットを
                IPv6のパケ ットに，それぞれ変換し，転送する。このとき， IPアドレス及
                びポート番号は，動的 NATによる書換えの考え方を用いて変換する。
                NAT64ルー タによる IPアドレスとポー ト番号の変換例を，図 1に示す。
            </li>
        </ul>
        <figure>
            <img src="mypage_fecbt_pm/2019r01a_fe_pm_qs/t4_2.png" alt="図 1 NAT64ルータによる IPアドレスとポート番号の変換例">
        </figure>
        <ul>
            <h3>aに関する解答群</h3>
            <table class="t4">
                <thead>
                    <tr>
                        <td></td>
                        <td>a1</td>
                        <td>a2</td>
                        <td>a3</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ア</td>
                        <td>IPv4</td>
                        <td>IPv4</td>
                        <td>IPv6</td>
                    </tr>
                    <tr>
                        <td>イ</td>
                        <td>IPv4</td>
                        <td>IPv6</td>
                        <td>IPv4</td>
                    </tr>
                    <tr>
                        <td>ウ</td>
                        <td>IPv6</td>
                        <td>IPv4</td>
                        <td>IPv6</td>
                    </tr>
                    <tr>
                        <td>エ</td>
                        <td>IPv6</td>
                        <td>IPv6</td>
                        <td>IPv4</td>
                    </tr>
                </tbody>
            </table>
        </ul>
        <ul class="row">
            <h3>b~dに関する解答群</h3>
            <li class="col-3">ア　192.168.0.0</li>
            <li class="col-3">イ　192.168.0.1</li>
            <li class="col-3">ウ　192.168.0.2</li>
            <li class="col-3">工　64:ff9b::</li>
            <li class="col-3">オ　64:ff9b::c0a8:1</li>
            <li class="col-3">カ　64:ff9b::c0a8:2</li>
            <li class="col-3">キ　fcOO:: </li>
            <li class="col-3">ク　fc00::1</li>
            <li class="col-3">ケ　fc00::2</li>
        </ul>
    </article>
</section>

<section id="t5">
    <h1>選択した問題については，「この問題を選択する」にチェックを入れてください。</h1>
    <h2><strong>問 5</strong>　</h2>
    準備中
</section>

<section id="t6">
    <h1>選択した問題については，「この問題を選択する」にチェックを入れてください。</h1>
    <h2><strong>問 6</strong>　</h2>
    準備中
</section>

<section id="t7">
    <h1>選択した問題については，「この問題を選択する」にチェックを入れてください。</h1>
    <h2><strong>問 7</strong>　</h2>
    準備中
</section>

<section id="t8">
    <h1>次の<strong>問 8</strong>は必須問題です。必ず解答してください。</h1>
    <h2><strong>問 8</strong>　</h2>
    準備中
</section>

<section id="t9">
    <h1>　次の問 9から 問 13までの 5問については，この中から 1問を選択し，選択した問題については，「この問題を選択する」にチェックを入れてください。</h1>
    <h2><strong>問 9</strong>　</h2>
    準備中
</section>

<section id="t10">
    <h1>選択した問題については，「この問題を選択する」にチェックを入れてください。</h1>
    <h2><strong>問 10</strong>　</h2>
    準備中
</section>

<section id="t11">
    <h1>選択した問題については，「この問題を選択する」にチェックを入れてください。</h1>
    <h2><strong>問 11</strong>　</h2>
    準備中
</section>

<section id="t12">
    <h1>選択した問題については，「この問題を選択する」にチェックを入れてください。</h1>
    <h2><strong>問 12</strong>　</h2>
    準備中
</section>

<section id="t13">
    <h1>選択した問題については，「この問題を選択する」にチェックを入れてください。</h1>
    <h2><strong>問 13</strong>　</h2>
    準備中
</section>