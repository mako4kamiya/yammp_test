## 最初に行う
### 1. Githubリポジトリのclone
```
git clone https://github.com/mako4kamiya/yammp_test.git
```

### 2.作業用ブランチに変更する
```
git checkout feature_miki
```
<br><br><br>

## 毎回の流れ
### 1.現在いるブランチを確認する
```
git branch
```
```
>  feature_mako
>  * feature_miki
>  main
```
*が現在いるブランチ。

**必ず作業用のブランチにいることを確認する。もし違うブランチにいれば、`git checkout feature_miki`で移動する**

### 2.作業する

### 3.変更されたファイルの確認
```
git status
```

### 4.すべての変更をステージング
```
git add -A
```

### 5.ステージングされたファイルの確認
```
git status
```
ステージングされたファイルは色が変わる。

### 6.ステージングしたファイルにコミットメッセージをつける
```
git commit -m "○○を変更しました"
```

### 7.コミットメッセージの確認
```
git log --oneline --graph
```
自分が設定したコミットメッセージが表示されるか確認。

表示されなければ、ステージング作業かコミットが間違っている可能性があるので再度確認してコミットする。

### 8.繰り返す

作業 → ステージング → コミット はキリのいいところで何度も行ってよい。

### 9.作業用ブランチにプッシュ
```
git push origin feature_miki
```
**すべての作業、コミットが終ったら、最低でも一日の最後の終わりにはプッシュする**

<br><br><br>

## 他の人の変更を自分の作業ブランチに統合する
他の人が作業したコードを統合して、アプリケーションを動かしたいときは、リモートのmainブランチをローカルのmainブランチに統合する必要がある。

**※必ず自分の作業が終って、ステージング、コミットしてから行う**


### 1.mainブランチに切り替える
```
git checkout main
```

### 2.mainブランチを作業ブランチに統合する(他の人の変更を統合する)
```
git pull
```

**※再度作業に戻る場合は、必ずブランチを切り替える**

### 3.作業用ブランチに変更する
```
git checkout feature_miki
```

### 1.現在いるブランチを確認する にもどる
<br><br><br>

***
# 初期設定

### Gitのインストール

https://gitforwindows.org/

### Gitの設定（コマンド）
```
git config --global user.name {自分の名前}
git config --global user.email {メールアドレス}
```

### Githubアカウントの作成

https://github.co.jp/

上記の{自分の名前}、{メールアドレス}で登録する。


## 【用語】
### Gitについてわかりやすいサイト

https://backlog.com/ja/git-tutorial/intro/01/

### Gitとは:

https://e-words.jp/w/Git.html　(e-words)

### Githubとは:

https://e-words.jp/w/GitHub.html　(e-words)

### リポジトリとは:

https://e-words.jp/w/%E3%83%AA%E3%83%9D%E3%82%B8%E3%83%88%E3%83%AA.html（e-words）

https://wa3.i-3-i.info/word15664.html（わわわ）
