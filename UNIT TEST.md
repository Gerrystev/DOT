# Unit Testing
Pada bagian ini akan menjelaskan mengenai apa saja unit tes yang dilakukan. Untuk melakukan testing cukup menjalankan perintah cmd dibawah

    php artisan test

Untuk testing yang dilakukan selengkapnya dijelaskan sebagai berikut

### Daftar Isi
 - [User Test](#user-test)
	 - [Create User A](#create-a)
	 - [Create User B](#create-b)
	 - [Create User C](#create-c)
	 - [Create Duplicate User A](#create-duplicate-a)
	 - [Valid Login User A](#valid-login-a)
	 - [Invalid Login User A](#invalid-login-a)
	 - [Valid Login User B](#valid-login-b)
	 - [Invalid Login User B](#invalid-login-b)
	 - [Valid Login User C](#valid-login-c)
	 - [Invalid Login User C](#invalid-login-b)
 - [Search Provinces](#search-provinces)
	 - [User A Can Search Provinces](#search-provinces-a)
	 - [User A Search Invalid Provinces](#search-provinces-a-invalid)
	 - [User B Can Search Provinces](#search-provinces-b)
	 - [User C Can Search Provinces](#search-provinces-c)
 - [Search Cities](#search-cities)
  	 - [User A Can Search Cities](#search-cities-a)
	 - [User A Search Invalid Cities](#search-cities-a-invalid)
	 - [User B Can Search Cities](#search-cities-b)
	 - [User C Can Search Cities](#search-cities-c)

## User Test <a name="user-test"/>
User test merupakan uji coba authentikasi suatu user

### Create User A<a name="create-a"/>
Pengujian pembuatan user baru yang terotorisasi dapat mencari provinisi dan kota
**Request yang dilakukan**
|Field Name    |Description             
|----------------|---------------------|
|username			|adminA      |
|password			|A12345      |
|search_provinces	|1		     |
|search_cities		|1      	 |

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|200 |

**Response Data Structure**
```json
'message',
'user' => [
	'username',
	'id',
],
'authorization' => [
	'token',
	'type',
],
```
### Create User B<a name="create-b"/>
Pengujian pembuatan user baru yang terotorisasi dapat mencari provinisi 

**Request yang dilakukan**
|Field Name    |Description             
|----------------|---------------------|
|username			|adminB      |
|password			|B12345      |
|search_provinces	|1		     |

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|200 |

**Response Data Structure**
```json
'message',
'user' => [
	'username',
	'id',
],
'authorization' => [
	'token',
	'type',
],
```
### Create User C<a name="create-c"/>
Pengujian pembuatan user baru yang terotorisasi dapat mencari kota

**Request yang dilakukan**
|Field Name    |Description             
|----------------|---------------------|
|username			|adminC      |
|password			|C12345      |
|search_cities		|1      	 |

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|200 |

**Response Data Structure**
```json
'message',
'user' => [
	'username',
	'id',
],
'authorization' => [
	'token',
	'type',
],
```

### Create Duplicate User A<a name="create-duplicate-a"/>
Pengujian pembuatan user A yang terduplikat
**Request yang dilakukan**
|Field Name    |Description             
|----------------|---------------------|
|username			|adminA      |
|password			|A12345      |

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|400|

**Response Data Structure**
```json
"username" => [
	"The username has already been taken."
]
```

### Valid Login User A<a name="valid-login-a"/>
Pengujian login user A yang valid

**Request yang dilakukan**
|Field Name    |Description             
|----------------|---------------------|
|username			|adminA      |
|password			|A12345      |

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|200|

**Response Data Structure**
```json
'user' => [
	'id',
	'username',
	'search_province',
	'search_city',
],
'authorization' => [
	'token',
	'type',
],
```

### Invalid Login User A<a name="invalid-login-a"/>
Pengujian login user A yang invalid

**Request yang dilakukan**
|Field Name    |Description             
|----------------|---------------------|
|username			|adminA      |
|password			|xxxxx      |

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|403|

**Response Data Structure**
```json
[
	'message' => 'Username or password wrong'
]
```

### Valid Login User B<a name="valid-login-b"/>
Pengujian login user B yang valid

**Request yang dilakukan**
|Field Name    |Description             
|----------------|---------------------|
|username			|adminB      |
|password			|B12345      |

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|200|

**Response Data Structure**
```json
'user' => [
	'id',
	'username',
	'search_province',
	'search_city',
],
'authorization' => [
	'token',
	'type',
],
```

### Invalid Login User B<a name="invalid-login-b"/>
Pengujian login user B yang invalid

**Request yang dilakukan**
|Field Name    |Description             
|----------------|---------------------|
|username			|adminB      |
|password			|xxxxx      |

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|403|

**Response Data Structure**
```json
[
	'message' => 'Username or password wrong'
]
```

### Valid Login User C<a name="valid-login-c"/>
Pengujian login user C yang valid

**Request yang dilakukan**
|Field Name    |Description             
|----------------|---------------------|
|username			|adminB      |
|password			|B12345      |

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|200|

**Response Data Structure**
```json
'user' => [
	'id',
	'username',
	'search_province',
	'search_city',
],
'authorization' => [
	'token',
	'type',
],
```
### Invalid Login User C<a name="invalid-login-c"/>
Pengujian login user C yang invalid

**Request yang dilakukan**
|Field Name    |Description             
|----------------|---------------------|
|username			|adminC      |
|password			|xxxxx      |

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|403|

**Response Data Structure**
```json
[
	'message' => 'Username or password wrong'
]
```

## Search Provinces<a name="search-provinces"/>
Uji coba pencarian provinsi dengan user terotorisasi

### User A Can Search Provinces<a name="search-provinces-a"/>
Pengujian User A yang terotorisasi mencari provinsi

**Request yang dilakukan**
GET /api/search/provinces?id=1  

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|200 |

**Response Data Structure**
```json
'data' => [
	'province_id',
	'province',
],
```

### User A Search Invalid Provinces<a name="search-provinces-a-invalid"/>
Pengujian User A yang terotorisasi mencari provinsi tidak terdaftar

**Request yang dilakukan**
GET /api/search/provinces?id=xxxx  

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|404|

### User B Can Search Provinces<a name="search-provinces-b"/>
Pengujian User B yang terotorisasi mencari provinsi

**Request yang dilakukan**
GET /api/search/provinces?id=1

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|200|

**Response Data Structure**
```json
'data' => [
	'province_id',
	'province',
],
```

### User C Cannot Search Provinces<a name="search-provinces-c"/>
Pengujian User C yang tidak terotorisasi mencari provinsi

**Request yang dilakukan**
GET /api/search/provinces?id=1  

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|401|

## Search Cities<a name="search-cities"/>
Uji coba pencarian kota dengan user terotorisasi

### User A Can Search Cities<a name="search-cities-a"/>
Pengujian User A yang terotorisasi mencari kota

**Request yang dilakukan**
GET /api/search/cities?id=1  

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|200 |

**Response Data Structure**
```json
'data' => [
	'city_id',
	'province_id',
	'province',
	'type',
	'city_name'
	'postal_code',
],
```

### User A Search Invalid Cities<a name="search-cities-a-invalid"/>
Pengujian User A yang terotorisasi mencari kota tidak terdaftar

**Request yang dilakukan**
GET /api/search/cities?id=xxxx  

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|404|

### User B Cannot Search Cities<a name="search-cities-b"/>
Pengujian User B yang tidak terotorisasi mencari kota

**Request yang dilakukan**
GET /api/search/cities?id=1

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|401 |

### User C Can Search Cities<a name="search-cities-c"/>
Pengujian User C yang terotorisasi mencari kota

**Request yang dilakukan**
GET /api/search/cities?id=1  

**Respon yang diinginkan**
|Response    | Expected Value           
|----------------|---------------------|
|Header			|content-type: application/json      |
|Status     		|200 |

**Response Data Structure**
```json
'data' => [
	'city_id',
	'province_id',
	'province',
	'type',
	'city_name'
	'postal_code',
],
```
