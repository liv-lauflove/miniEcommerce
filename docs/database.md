# Entity Relationship Diagram (ERD)

Berikut adalah struktur relasi database untuk sistem **miniEcommerce UD Trisna Putra**.

```mermaid
erDiagram
    USERS {
        bigint id PK
        string name
        string email
        string password
        string role "admin, customer"
        timestamp created_at
        timestamp updated_at
    }

    CATEGORIES {
        bigint id PK
        string name
        string slug
        string description
        timestamp created_at
        timestamp updated_at
    }

    PRODUCTS {
        bigint id PK
        bigint category_id FK
        string name
        string slug
        text description
        decimal price
        int stock
        string image_url
        timestamp created_at
        timestamp updated_at
    }

    ORDERS {
        bigint id PK
        bigint user_id FK
        string order_number
        string status "pending, processing, completed, cancelled"
        decimal total_amount
        text shipping_address
        timestamp created_at
        timestamp updated_at
    }

    ORDER_ITEMS {
        bigint id PK
        bigint order_id FK
        bigint product_id FK
        int quantity
        decimal price
        decimal subtotal
        timestamp created_at
        timestamp updated_at
    }

    USERS ||--o{ ORDERS : places
    CATEGORIES ||--o{ PRODUCTS : contains
    PRODUCTS ||--o{ ORDER_ITEMS : "included in"
    ORDERS ||--|{ ORDER_ITEMS : has
```

### Penjelasan Tabel:
1. **users**: Menyimpan data akun pengguna baik *Admin* maupun *Customer*. Role menentukan hak akses sistem.
2. **categories**: Menyimpan kategori produk (misal: Bahan Kue, Plastik, Kemasan).
3. **products**: Menyimpan detail produk beserta stok dan harga. Berelasi langsung dengan tabel `categories`.
4. **orders**: Menyimpan data transaksi pesanan secara umum (header).
5. **order_items**: Menyimpan detail produk apa saja yang dibeli pada sebuah order (detail).
