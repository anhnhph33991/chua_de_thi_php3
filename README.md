### Oke E Tùng Lâm <3 6789

### 1. Sau khi cài xong project . Vào file .env chỉnh

```
    APP_URL=<đường dẫn dự án/>
    DB_DATABASE=<tên database/>
    FILESYSTEM_DISK=public
```

### 2. Tạo all file:

```
    php artisan make:model Product --all
    php artisan make:controller Api/ProductController --api
    php artisan storage:link

    -Tạo file views với cấu trúc:

    -layouts
     |master.blade.php
    -products
     |index.blade.php
     |create.blade.php

    -Tạo route trong file web.php và api.php
```

### 3. Ctrl + P / tìm file create_products.php tiến hành tạo migration

### 4. Sau khi tạo xong: php artisan migrate

### 4. Ctrl + P / tìm file Product.php tạo fillable

### 5. Code logic trước, code view sau

### 6. Vào file Handler.php trong folder Exceptions

```
    protected function shouldReturnJson($request, Throwable $e)
    {
        if ($request->is('api/*') || $request->wantsJson() || $request->ajax()) {
            return true;
        }

        return false;
    }
```

### 7. Logic update như store bên web 
