<?php


use Phinx\Seed\AbstractSeed;

class QuestionSeeder extends AbstractSeed
{
    public function run()
    {
        $sql = "INSERT INTO questions(
                id,collectAnswer,toi,setsumon,allotion,sentakuGroup,sentakushi,fieldName,examName
                )VALUES
                (1,'エ',1,'1a',12,'必須1',4,'情報セキュリティ','令和元年度秋期'),
                (2,'オ',1,'1b',12,'必須1',9,'情報セキュリティ','令和元年度秋期'),
                (3,'オ',1,'2',12,'必須1',6,'情報セキュリティ','令和元年度秋期'),
                (4,'イ',1,'3',12,'必須1',4,'情報セキュリティ','令和元年度秋期'),
                (5,'オ',2,'1a',12,'選択1',5,'ソフトウェア','令和元年度秋期'),
                (6,'ウ',2,'1b',12,'選択1',5,'ソフトウェア','令和元年度秋期'),
                (7,'ウ',2,'2c',12,'選択1',4,'ソフトウェア','令和元年度秋期'),
                (8,'イ',2,'2d',12,'選択1',4,'ソフトウェア','令和元年度秋期'),
                (9,'エ',2,'3e',12,'選択1',4,'ソフトウェア','令和元年度秋期'),
                (10,'エ',3,'1a',12,'選択1',4,'データベース','令和元年度秋期'),
                (11,'イ',3,'1b',12,'選択1',4,'データベース','令和元年度秋期'),
                (12,'イ',3,'2c',12,'選択1',4,'データベース','令和元年度秋期'),
                (13,'ア',3,'3d',12,'選択1',4,'データベース','令和元年度秋期'),
                (14,'カ',3,'3e',12,'選択1',6,'データベース','令和元年度秋期'),
                (15,'エ',4,'1',12,'選択1',6,'ネットワーク','令和元年度秋期'),
                (16,'エ',4,'2a',12,'選択1',4,'ネットワーク','令和元年度秋期'),
                (17,'ウ',4,'2b',12,'選択1',9,'ネットワーク','令和元年度秋期'),
                (18,'イ',4,'2c',12,'選択1',9,'ネットワーク','令和元年度秋期'),
                (19,'カ',4,'2d',12,'選択1',9,'ネットワーク','令和元年度秋期'),
                (20,'ア',5,'1a',12,'選択1',8,'ソフトウェア設計','令和元年度秋期'),
                (21,'オ',5,'1b',12,'選択1',8,'ソフトウェア設計','令和元年度秋期'),
                (22,'ク',5,'1c',12,'選択1',8,'ソフトウェア設計','令和元年度秋期'),
                (23,'キ',5,'1d',12,'選択1',8,'ソフトウェア設計','令和元年度秋期'),
                (24,'オ',5,'2e',12,'選択1',10,'ソフトウェア設計','令和元年度秋期'),
                (25,'ク',5,'2f',12,'選択1',10,'ソフトウェア設計','令和元年度秋期'),
                (26,'ア',6,'1a',12,'選択1',3,'プロジェクトマネジメント','令和元年度秋期'),
                (27,'ア',6,'1b',12,'選択1',3,'プロジェクトマネジメント','令和元年度秋期'),
                (28,'エ',6,'1c',12,'選択1',4,'プロジェクトマネジメント','令和元年度秋期'),
                (29,'エ',6,'2d',12,'選択1',4,'プロジェクトマネジメント','令和元年度秋期'),
                (30,'イ',6,'2e',12,'選択1',5,'プロジェクトマネジメント','令和元年度秋期'),
                (31,'イ',6,'3f',12,'選択1',4,'プロジェクトマネジメント','令和元年度秋期'),
                (32,'イ',7,'1a',12,'選択1',4,'経営戦略・企業と法務','令和元年度秋期'),
                (33,'イ',7,'1b',12,'選択1',4,'経営戦略・企業と法務','令和元年度秋期'),
                (34,'ア',7,'2c',12,'選択1',4,'経営戦略・企業と法務','令和元年度秋期'),
                (35,'イ',7,'3d',12,'選択1',5,'経営戦略・企業と法務','令和元年度秋期'),
                (36,'ウ',7,'3e',12,'選択1',4,'経営戦略・企業と法務','令和元年度秋期'),
                (37,'イ',8,'1a',20,'必須2',4,'データ構造及びアルゴリズム','令和元年度秋期'),
                (38,'ア',8,'1b',20,'必須2',5,'データ構造及びアルゴリズム','令和元年度秋期'),
                (39,'ア',8,'1c',20,'必須2',5,'データ構造及びアルゴリズム','令和元年度秋期'),
                (40,'イ',8,'2d',20,'必須2',7,'データ構造及びアルゴリズム','令和元年度秋期'),
                (41,'キ',8,'2e',20,'必須2',7,'データ構造及びアルゴリズム','令和元年度秋期'),
                (42,'カ',8,'2f',20,'必須2',7,'データ構造及びアルゴリズム','令和元年度秋期'),
                (43,'カ',8,'3g',20,'必須2',6,'データ構造及びアルゴリズム','令和元年度秋期'),
                (44,'イ',8,'3h',20,'必須2',4,'データ構造及びアルゴリズム','令和元年度秋期'),
                (45,'ウ',8,'3i',20,'必須2',6,'データ構造及びアルゴリズム','令和元年度秋期'),
                (46,'ア',9,'1a',20,'選択2',4,'ソフトウェア開発（C）','令和元年度秋期'),
                (47,'イ',9,'1b',20,'選択2',4,'ソフトウェア開発（C）','令和元年度秋期'),
                (48,'ア',9,'1c',20,'選択2',4,'ソフトウェア開発（C）','令和元年度秋期'),
                (49,'オ',9,'1d',20,'選択2',6,'ソフトウェア開発（C）','令和元年度秋期'),
                (50,'オ',9,'2e',20,'選択2',6,'ソフトウェア開発（C）','令和元年度秋期'),
                (51,'ウ',9,'2f',20,'選択2',6,'ソフトウェア開発（C）','令和元年度秋期'),
                (52,'エ',10,'1a',20,'選択2',4,'ソフトウェア開発（COBOL）','令和元年度秋期'),
                (53,'オ',10,'1b',20,'選択2',5,'ソフトウェア開発（COBOL）','令和元年度秋期'),
                (54,'イ',10,'1c',20,'選択2',5,'ソフトウェア開発（COBOL）','令和元年度秋期'),
                (55,'イ',10,'1d',20,'選択2',4,'ソフトウェア開発（COBOL）','令和元年度秋期'),
                (56,'ウ',10,'2e',20,'選択2',4,'ソフトウェア開発（COBOL）','令和元年度秋期'),
                (57,'ア',10,'2f',20,'選択2',5,'ソフトウェア開発（COBOL）','令和元年度秋期'),
                (58,'イ',11,'1a',20,'選択2',6,'ソフトウェア開発（Java）','令和元年度秋期'),
                (59,'オ',11,'1b',20,'選択2',6,'ソフトウェア開発（Java）','令和元年度秋期'),
                (60,'イ',11,'1c',20,'選択2',6,'ソフトウェア開発（Java）','令和元年度秋期'),
                (61,'オ',11,'1d',20,'選択2',6,'ソフトウェア開発（Java）','令和元年度秋期'),
                (62,'ウ',11,'1e',20,'選択2',6,'ソフトウェア開発（Java）','令和元年度秋期'),
                (63,'オ',11,'2',20,'選択2',6,'ソフトウェア開発（Java）','令和元年度秋期'),
                (64,'ア',12,'1a',20,'選択2',6,'ソフトウェア開発（アセンブラ言語）','令和元年度秋期'),
                (65,'ア',12,'1b',20,'選択2',5,'ソフトウェア開発（アセンブラ言語）','令和元年度秋期'),
                (66,'イ',12,'1c',20,'選択2',6,'ソフトウェア開発（アセンブラ言語）','令和元年度秋期'),
                (67,'エ',12,'2d',20,'選択2',5,'ソフトウェア開発（アセンブラ言語）','令和元年度秋期'),
                (68,'エ',12,'2e',20,'選択2',6,'ソフトウェア開発（アセンブラ言語）','令和元年度秋期'),
                (69,'正解なし',12,'2f',20,'選択2',6,'ソフトウェア開発（アセンブラ言語）','令和元年度秋期'),
                (70,'オ',12,'3g',20,'選択2',5,'ソフトウェア開発（アセンブラ言語）','令和元年度秋期'),
                (71,'ウ',12,'3h',20,'選択2',5,'ソフトウェア開発（アセンブラ言語）','令和元年度秋期'),
                (72,'エ',13,'1a',20,'選択2',6,'ソフトウェア開発（表計算）','令和元年度秋期'),
                (73,'エ',13,'1b',20,'選択2',6,'ソフトウェア開発（表計算）','令和元年度秋期'),
                (74,'ウ',13,'1c',20,'選択2',6,'ソフトウェア開発（表計算）','令和元年度秋期'),
                (75,'キ',13,'2d',20,'選択2',8,'ソフトウェア開発（表計算）','令和元年度秋期'),
                (76,'キ',13,'2e',20,'選択2',8,'ソフトウェア開発（表計算）','令和元年度秋期'),
                (77,'イ',13,'2f',20,'選択2',6,'ソフトウェア開発（表計算）','令和元年度秋期')";
        $this->execute($sql);

        $sql = "INSERT INTO questions(
            id,collectAnswer,toi,setsumon,allotion,sentakuGroup,sentakushi,fieldName,examName
            )VALUES
            (78,'カ',1,'1a',12,'必須1',9,'情報セキュリティ','平成31年度春期'),
            (79,'イ',1,'1b',12,'必須1',9,'情報セキュリティ','平成31年度春期'),
            (80,'ウ',1,'1c',12,'必須1',9,'情報セキュリティ','平成31年度春期'),
            (81,'エ',1,'2d',12,'必須1',4,'情報セキュリティ','平成31年度春期'),
            (82,'イ',1,'2e',12,'必須1',5,'情報セキュリティ','平成31年度春期'),
            (83,'ウ',2,'1a',12,'選択1',5,'ソフトウェア','平成31年度春期'),
            (84,'エ',2,'2b',12,'選択1',4,'ソフトウェア','平成31年度春期'),
            (85,'ア',2,'2c',12,'選択1',4,'ソフトウェア','平成31年度春期'),
            (86,'ア',2,'3d',12,'選択1',9,'ソフトウェア','平成31年度春期'),
            (87,'エ',2,'3e',12,'選択1',9,'ソフトウェア','平成31年度春期'),
            (88,'ア',3,'1a',12,'選択1',6,'データベース','平成31年度春期'),
            (89,'ウ',3,'1b',12,'選択1',5,'データベース','平成31年度春期'),
            (90,'ア',3,'1c',12,'選択1',4,'データベース','平成31年度春期'),
            (91,'エ',3,'2d',12,'選択1',5,'データベース','平成31年度春期'),
            (92,'ウ',3,'2e',12,'選択1',5,'データベース','平成31年度春期'),
            (93,'ア',3,'3f',12,'選択1',6,'データベース','平成31年度春期'),
            (94,'イ',4,'1a',12,'選択1',6,'ネットワーク','平成31年度春期'),
            (95,'ア',4,'1b',12,'選択1',4,'ネットワーク','平成31年度春期'),
            (96,'ウ',4,'1c',12,'選択1',4,'ネットワーク','平成31年度春期'),
            (97,'ア',4,'2',12,'選択1',4,'ネットワーク','平成31年度春期'),
            (98,'イ',4,'3',12,'選択1',4,'ネットワーク','平成31年度春期'),
            (99,'カ',5,'1a',12,'選択1',6,'ソフトウェア設計','平成31年度春期'),
            (100,'オ',5,'1b',12,'選択1',6,'ソフトウェア設計','平成31年度春期'),
            (101,'エ',5,'1c',12,'選択1',6,'ソフトウェア設計','平成31年度春期'),
            (102,'イ',5,'2d',12,'選択1',7,'ソフトウェア設計','平成31年度春期'),
            (103,'オ',5,'3e',12,'選択1',5,'ソフトウェア設計','平成31年度春期'),
            (104,'エ',6,'1a',12,'選択1',4,'プロジェクトマネジメント','平成31年度春期'),
            (105,'イ',6,'1b',12,'選択1',4,'プロジェクトマネジメント','平成31年度春期'),
            (106,'キ',6,'2c',12,'選択1',7,'プロジェクトマネジメント','平成31年度春期'),
            (107,'ア',6,'2d',12,'選択1',4,'プロジェクトマネジメント','平成31年度春期'),
            (108,'ウ',6,'2e',12,'選択1',4,'プロジェクトマネジメント','平成31年度春期'),
            (109,'オ',6,'2f',12,'選択1',8,'プロジェクトマネジメント','平成31年度春期'),
            (110,'エ',6,'2g',12,'選択1',8,'プロジェクトマネジメント','平成31年度春期'),
            (111,'イ',6,'2h',12,'選択1',4,'プロジェクトマネジメント','平成31年度春期'),
            (112,'ア',7,'1a',12,'選択1',3,'システム戦略','平成31年度春期'),
            (113,'イ',7,'1b',12,'選択1',5,'システム戦略','平成31年度春期'),
            (114,'ア',7,'1c',12,'選択1',4,'システム戦略','平成31年度春期'),
            (115,'ウ',7,'1d',12,'選択1',4,'システム戦略','平成31年度春期'),
            (116,'ウ',7,'2e',12,'選択1',4,'システム戦略','平成31年度春期'),
            (117,'ウ',7,'2f',12,'選択1',4,'システム戦略','平成31年度春期'),
            (118,'イ',7,'3g',12,'選択1',4,'システム戦略','平成31年度春期'),
            (119,'ア',8,'1a',20,'必須2',4,'データ構造及びアルゴリズム','平成31年度春期'),
            (120,'イ',8,'1b',20,'必須2',4,'データ構造及びアルゴリズム','平成31年度春期'),
            (121,'ウ',8,'2c',20,'必須2',7,'データ構造及びアルゴリズム','平成31年度春期'),
            (122,'エ',8,'2d',20,'必須2',7,'データ構造及びアルゴリズム','平成31年度春期'),
            (123,'オ',8,'3e',20,'必須2',5,'データ構造及びアルゴリズム','平成31年度春期'),
            (124,'イ',8,'3f',20,'必須2',4,'データ構造及びアルゴリズム','平成31年度春期'),
            (125,'イ',9,'1a',20,'選択2',3,'ソフトウェア開発（C）','平成31年度春期'),
            (126,'カ',9,'1b',20,'選択2',6,'ソフトウェア開発（C）','平成31年度春期'),
            (127,'イ',9,'1c',20,'選択2',6,'ソフトウェア開発（C）','平成31年度春期'),
            (128,'ウ',9,'2d',20,'選択2',4,'ソフトウェア開発（C）','平成31年度春期'),
            (129,'エ',9,'2e',20,'選択2',4,'ソフトウェア開発（C）','平成31年度春期'),
            (130,'イ',9,'2f',20,'選択2',3,'ソフトウェア開発（C）','平成31年度春期'),
            (131,'イ',9,'2g',20,'選択2',4,'ソフトウェア開発（C）','平成31年度春期'),
            (132,'エ',10,'1a',20,'選択2',4,'ソフトウェア開発（COBOL）','平成31年度春期'),
            (133,'ア',10,'1b',20,'選択2',4,'ソフトウェア開発（COBOL）','平成31年度春期'),
            (134,'イ',10,'1c',20,'選択2',6,'ソフトウェア開発（COBOL）','平成31年度春期'),
            (135,'カ',10,'1d',20,'選択2',6,'ソフトウェア開発（COBOL）','平成31年度春期'),
            (136,'エ',10,'2e',20,'選択2',4,'ソフトウェア開発（COBOL）','平成31年度春期'),
            (137,'ア',10,'2f',20,'選択2',4,'ソフトウェア開発（COBOL）','平成31年度春期'),
            (138,'ウ',11,'1a',20,'選択2',8,'ソフトウェア開発（Java）','平成31年度春期'),
            (139,'ア',11,'1b',20,'選択2',8,'ソフトウェア開発（Java）','平成31年度春期'),
            (140,'エ',11,'1c',20,'選択2',4,'ソフトウェア開発（Java）','平成31年度春期'),
            (141,'ア',11,'1d',20,'選択2',4,'ソフトウェア開発（Java）','平成31年度春期'),
            (142,'ウ',11,'2e',20,'選択2',3,'ソフトウェア開発（Java）','平成31年度春期'),
            (143,'ウ',11,'2f',20,'選択2',3,'ソフトウェア開発（Java）','平成31年度春期'),
            (144,'オ',12,'1a',20,'選択2',6,'ソフトウェア開発（アセンブラ言語）','平成31年度春期'),
            (145,'オ',12,'1b',20,'選択2',6,'ソフトウェア開発（アセンブラ言語）','平成31年度春期'),
            (146,'オ',12,'1c',20,'選択2',6,'ソフトウェア開発（アセンブラ言語）','平成31年度春期'),
            (147,'カ',12,'1d',20,'選択2',6,'ソフトウェア開発（アセンブラ言語）','平成31年度春期'),
            (148,'イ',12,'2e',20,'選択2',3,'ソフトウェア開発（アセンブラ言語）','平成31年度春期'),
            (149,'オ',12,'2f',20,'選択2',6,'ソフトウェア開発（アセンブラ言語）','平成31年度春期'),
            (150,'カ',13,'1a',20,'選択2',6,'ソフトウェア開発（表計算）','平成31年度春期'),
            (151,'ウ',13,'1b',20,'選択2',4,'ソフトウェア開発（表計算）','平成31年度春期'),
            (152,'ウ',13,'1c',20,'選択2',5,'ソフトウェア開発（表計算）','平成31年度春期'),
            (153,'オ',13,'2d',20,'選択2',6,'ソフトウェア開発（表計算）','平成31年度春期'),
            (154,'オ',13,'2e',20,'選択2',6,'ソフトウェア開発（表計算）','平成31年度春期')";
        $this->execute($sql);
    }
}
