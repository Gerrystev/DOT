# INSTALLATION
Dalam Readme ini akan menjelaskan mengenai cara instalasi project. Adapun daftar isi sebagai berikut:

### Daftar Isi
1. [Install Dependencies](#dependencies)
2. [Migrasi Database](#migration)
3. [Fetching Data](#fetch-data)

## Install Dependencies<a name="dependencies"/>
Pertama-tama lakukan instalasi dependecies dengan menjalankan perintah dengan cmd pada folder project sebagai berikut:

    php composer.phar update

## Migrasi Database<a name="migration"/>
Sebelum melakukan migrasi database, pertama-tama buatlah database mysql dengan nama:

    dot

Lalu jalankan perintah dibawah untuk melakukan migrasi

    php artisan migrate

## Fetching Data<a name="fetch-data"/>

Selanjutnya lakukan fetch data provinsi dan kota dari rajaongkir-api dengan menjalankan perintah dibawah

    php artisan fetch:provinces
    php artisan fetch:cities
Maka data akan diambil dan disimpan pada database mysql. Fetch data bisa dilakukan untuk penambahan data atau pembaharuan data.
