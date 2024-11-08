```markdown
# Random Name Picker Application

Aplikasi ini digunakan untuk mengacak nama dan menentukan target. Pengguna dapat mengakses fitur untuk menentukan siapa targetnya di halaman `/random-names`. Proyek ini terbuka untuk kontribusi dari pengembang lain.

## Fitur

- Mengacak nama dari daftar yang telah diinput.
- Menentukan target dari hasil acak.
- Halaman interaktif untuk mengacak nama di `/random-names`.

## Persyaratan Sistem

Sebelum menjalankan proyek ini, pastikan Anda telah menginstal:

- PHP versi 7.4 atau lebih baru
- Composer
- MySQL atau database lain yang didukung Laravel
- Web server seperti Apache atau Nginx

## Instalasi

1. **Clone Repository:**
   ```bash
   git clone https://github.com/username/repo-name.git
   ```

2. **Masuk ke Direktori Proyek:**
   ```bash
   cd repo-name
   ```

3. **Instal Dependensi Composer:**
   ```bash
   composer install
   ```

4. **Siapkan Environment File:**
   Salin file `.env.example` menjadi `.env` dan atur konfigurasi yang sesuai, terutama pada bagian database:
   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

6. **Migrasi Database:**
   Pastikan Anda sudah menyiapkan database kosong, kemudian lakukan migrasi:
   ```bash
   php artisan migrate
   ```

7. **Jalankan Server Lokal:**
   Setelah semua langkah selesai, Anda bisa menjalankan server lokal dengan perintah:
   ```bash
   php artisan serve
   ```

8. **Akses Aplikasi:**
   Buka browser dan akses:
   ```
   http://localhost:8000/random-names
   ```

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini:

1. **Fork Repository:**
   Klik tombol `Fork` di GitHub.

2. **Clone Fork Anda:**
   ```bash
   git clone https://github.com/username/forked-repo.git
   ```

3. **Buat Branch Baru:**
   ```bash
   git checkout -b nama-branch-anda
   ```

4. **Lakukan Perubahan dan Commit:**
   ```bash
   git commit -m "Deskripsi perubahan"
   ```

5. **Push Branch Anda:**
   ```bash
   git push origin nama-branch-anda
   ```

6. **Buat Pull Request:**
   Setelah melakukan push, buat pull request ke repository utama.

## Konfigurasi Environment

Pastikan untuk mengatur konfigurasi berikut di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=acak-nama
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan nilai-nilai di atas dengan konfigurasi server lokal Anda.
