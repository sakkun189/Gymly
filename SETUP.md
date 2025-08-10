# Gymly セットアップガイド

## 必要な環境

### PHP環境
- PHP 8.2以上
- Composer（PHP依存関係管理）
- Laravel 12

### データベース
- PostgreSQL（本番環境）
- SQLite（開発環境）

### フロントエンド
- Node.js（npm/yarn）
- Bootstrap 5

## インストール手順

### 1. PHP開発環境のセットアップ

#### オプション A: XAMPP（推奨）
1. [XAMPP](https://www.apachefriends.org/download.html)をダウンロード
2. PHP 8.2以上を含むバージョンをインストール
3. Composerを[公式サイト](https://getcomposer.org/)からダウンロード・インストール

#### オプション B: Laravel Sail（Docker）
1. Docker Desktopをインストール
2. Laravelプロジェクト作成時にSailを使用

### 2. Laravelプロジェクトの作成

```bash
# Composerを使用してLaravelプロジェクトを作成
composer create-project laravel/laravel gymly-app

# プロジェクトディレクトリに移動
cd gymly-app

# Laravel Breezeをインストール（認証機能）
composer require laravel/breeze --dev
php artisan breeze:install blade

# 依存関係をインストール
npm install
npm run build
```

### 3. データベース設定

#### SQLite（開発環境）
```bash
# .envファイルを編集
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite

# データベースファイルを作成
touch database/database.sqlite

# マイグレーションを実行
php artisan migrate
```

#### PostgreSQL（本番環境）
```bash
# .envファイルを編集
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=gymly_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. 開発サーバーの起動

```bash
# Laravelサーバーを起動
php artisan serve

# フロントエンドの監視（別ターミナル）
npm run dev
```

## プロジェクト構成

```
gymly-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   ├── UserController.php
│   │   │   ├── GymController.php
│   │   │   ├── EquipmentController.php
│   │   │   ├── WorkoutController.php
│   │   │   └── MatchingController.php
│   │   └── Requests/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Gym.php
│   │   ├── Equipment.php
│   │   ├── Workout.php
│   │   └── TrainingRecord.php
│   └── Services/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── auth/
│   │   ├── dashboard/
│   │   ├── gym/
│   │   ├── workout/
│   │   └── layouts/
│   ├── css/
│   └── js/
├── routes/
│   ├── web.php
│   └── api.php
└── public/
```

## 主要機能の実装計画

1. **ユーザー登録・認証** (Laravel Breeze)
2. **ジム設備登録**
3. **トレーニングメニュー提案**
4. **週間プラン作成**
5. **記録・分析**
6. **マッチング機能**

## 開発の進め方

1. 基本的なLaravelプロジェクトをセットアップ
2. データベース設計とマイグレーション作成
3. 認証機能をカスタマイズ
4. 各機能を段階的に実装

## 次のステップ

1. PHP環境をセットアップ
2. Laravelプロジェクトを作成
3. データベース設計を開始
