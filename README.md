# News Aggregator API

A Laravel-powered API that aggregates news articles from multiple external sources into a single, unified database.  
It provides endpoints for articles, categories, sources, authors, and user preferences.


## Features
- Aggregate news articles from news sources into one database
- Search and filter articles by category, source, date, and user preferences
- Store user-specific preferences for personalized results


## Installation

### 1. Clone the Repository
```bash
git clone https://github.com/AbdulHameedAnofi/news-aggregator-api.git
cd news-aggregator-api
````

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Setup

Copy `.env.example` to `.env` and update values:

```bash
cp .env.example .env
```

Update:

* Database connection
* API keys for integrated news providers

### 4. Run Migrations

```bash
php artisan migrate
```

### 5. (Optional) Seed Database

```bash
php artisan db:seed
```

### 6. Start the Application

```bash
php artisan serve
```


## 📡 API Endpoints

### 🔹 Articles

`GET /api/articles`
Fetches a list of aggregated articles based on users preferences.

**Query Parameters:**

* `search` → search text in title/content/...
* `category` → filter by category
* `source` → filter by source
* `date` → filter by date


### 🔹 Categories

`GET /api/categories`
Returns a list of unique categories from all aggregated articles.


### 🔹 Sources

`GET /api/sources`
Returns a list of unique article sources.


### 🔹 Authors

`GET /api/authors`
Returns a list of unique authors/bylines.


### 🔹 User Preferences

`POST /api/user/preference`
Stores a user’s news preferences (e.g., preferred categories, sources, or authors).

**Request Body:**

```json
{
  "session_id": "(string)",
  "categories": ["Technology", "Sports"],
  "sources": ["the_guardian", "news_api"],
  "authors": ["John Doe"]
}
```


## 📝 Roadmap

* Sessions for user preferences
* Advanced filtering (date range, tags)
* Caching for performance