<?php


use Phinx\Seed\AbstractSeed;

class FieldSeeder extends AbstractSeed
{
    public function run()
    {
        $sql = "INSERT INTO fieldsBank
            (
                fieldName
            )
            VALUES
            ('情報セキュリティ'),
            ('ソフトウェア'),
            ('ハードウェア'),
            ('データベース'),
            ('ネットワーク'),
            ('ソフトウェア設計'),
            ('プロジェクトマネジメント'),
            ('サービスマネジメント'),
            ('ITサービスマネジメント'),
            ('システム戦略'),
            ('経営戦略・企業と法務'),
            ('経営・関連法規'),
            ('データ構造及びアルゴリズム'),
            ('ソフトウェア開発（C）'),
            ('ソフトウェア開発（Java）'),
            ('ソフトウェア開発（Python）'),
            ('ソフトウェア開発（アセンブラ言語）'),
            ('ソフトウェア開発（表計算）'),
            ('ソフトウェア開発（COBOL）')
            ;"
        ;
        $this->execute($sql);
    }
}
