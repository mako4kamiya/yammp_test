## 最初に行う
### Githubリポジトリのclone
`git clone https://github.com/mako4kamiya/yammp_test.git`

### 作業用ブランチに変更する
`git checkout feature_miki`


## 毎回の流れ
### 現在いるブランチを確認する
`git branch`
>  feature_mako
>* feature_miki
>  main
*が現在いるブランチ。
必ず作業用のブランチにいることを確認する。
もし違うブランチにいれば、`git checkout feature_miki`で移動する

## 作業する

### すべての変更をステージング
`git add -A`

### ステージング済みをコミット
`git commit -m "○○を変更しました"`

### 作業用ブランチにプッシュ
`git push origin feature_miki`