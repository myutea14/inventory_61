# Dokumentasi RESTful API v1 - Inventory System

**Base URL:** `http://localhost:8000/api/v1`

---
# Dokumentasi API Inventory

## Endpoint Items

`GET /api/v1/items?category_id={id}`

**Description:** Filter items by category, optional. Jika `category_id` tidak disertakan, akan menampilkan semua data.

## 1. Authentication Endpoints

### a. Register User
Mendaftarkan akun pengguna baru ke dalam sistem.
* **Method:** `POST`
* **URL:** `/register`
* **Headers:** 
  * `Accept: application/json`
* **Body (JSON):**
```json
  {
    "name": "Myuteaaa",
    "email": "myuteaa@gmail.com",
    "password": "password123",
    "password_confirmation": "myute"
  }

  {
    "success": true,
    "message": "User berhasil didaftarkan.",
    "data": {
      "id": 61,
      "name": "Myuteaaa",
      "email": "myuteaa@gmail.com"
    }
  }

  {
    "email": "myuteaa@gmail.com",
    "password": "myute"
  }

  {
    "success": true,
    "message": "Login berhasil.",
    "data": {
      "token": "1|laravel_sanctum_token_string_example..."
    }
  }

  {
    "success": true,
    "message": "Berhasil mengambil semua data item.",
    "data": [
      {
        "id": 1,
        "name": "Laptop",
        "description": "Laptop Asus ROG",
        "price": 15000000,
        "stock": 61,
        "category_id": 1
      }
    ]
  }

  {
    "name": "<script>Laptop</script>",
    "description": "  Spesifikasi Gaming  ",
    "price": 15000000,
    "stock": 61,
    "category_id": 1
  }

  {
    "success": true,
    "message": "Item berhasil dibuat.",
    "data": {
      "id": 2,
      "name": "Laptop",
      "description": "Spesifikasi Gaming",
      "price": 15000000,
      "stock": 61,
      "category_id": 1
    }
  }
  {
    "success": false,
    "message": "Item tidak ditemukan.",
    "errors": []
  }