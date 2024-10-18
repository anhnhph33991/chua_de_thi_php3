### 1. Sau khi cài xong project . Vào file .env chỉnh

```
    APP_URL=<đường dẫn dự án/> 
    DB_DATABASE=<tên database/> 
    FILESYSTEM_DISK=public
```

### 2. Tạo all file: 

```
    php artisan make:model Product --all
    php artisan make:controller Api/ProductController

    -Tạo file views với cấu trúc
    
    -layouts
     |master.blade.php
    -products
     |index.blade.php
     |create.blade.php
```
