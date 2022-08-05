# API
Disini akan dijelaskan ketentuan dan cara penggunaan API
### Daftar Isi
 - [User Auth](#user-auth)
	 - [Register](#register)
	 - [Login](#login)
	 - [Refresh Token](#refresh)
	 - [Logout](#logout)
 - [Search Provinces](#search-provinces)
 - [Search Cities](#search-cities)

## User Auth<a name="user-auth"/>
Digunakan untuk mengatur authentikasi dan authorisasi halaman.

### Register<a name="register"/>
Digunakan untuk menambah user baru <br />

**Method**  <br />
POST http://127.0.0.1:8000/api/auth/register <br />

**Header**  <br />
Accept	: application/json <br />

**Body** 
|Field Name    |Description             |Default
|----------------|---------------------|-----------------------------|
|username			|Username, UNIQUE      | NOT NULL | 
|password     		|Password, Min 6 huruf | NOT NULL|
|Search Provinces	|Apakah Terotorisasi untuk mencari provinsi	   |0|
|Search Cities		|Apakah Terotorisasi untuk mencari kota	   |0|

**Success JSON Response** 
//success

### Login<a name="login"/>
Digunakan untuk user yang sudah terdaftar untuk login <br />

**Method**  <br />
POST http://127.0.0.1:8000/api/auth/login<br />

**Header**  <br />
Accept	: application/json <br />

**Body** 
|Field Name    |Description             |Default
|----------------|---------------------|-----------------------------|
|username			|Username, UNIQUE      | NOT NULL | 
|password     		|Password, Min 6 huruf | NOT NULL |

**Success JSON Response** 
//success

### Refresh Token<a name="refresh"/>
Digunakan untuk refresh bearer token<br />

**Method**  <br />
POST http://127.0.0.1:8000/api/auth/refresh<br />

**Header**  <br />
Accept	: application/json <br />
Authorization	: bearer_token <br />

**Body** 
|Field Name    |Description             |Default
|----------------|---------------------|-----------------------------|
|username			|Username, UNIQUE, NOT NULL      | | 
|password     		|Password, Min 6 huruf, NOT NULL | |
|Search Provinces	|Apakah Terotorisasi untuk mencari provinsi	   |0|
|Search Cities		|Apakah Terotorisasi untuk mencari kota	   |0|

**Success JSON Response** 
//success

### Logout<a name="logout"/>
Digunakan untuk user logout<br />

**Method**  <br />
POST http://127.0.0.1:8000/api/auth/logout<br />

**Header**  <br />
Accept	: application/json <br />
Authorization	: bearer_token <br />

## Search Provinces<a name="search-provinces"/>
Digunakan untuk mencari provinsi bagi user yang terotorisasi.

**Method**  <br />
GET http://127.0.0.1:8000/api/search/provinces? <parameter\><br />

**Header**  <br />
Accept	: application/json <br />
Authorization	: bearer_token <br />

**Parameter** 
|Field Name    |Description             
|----------------|---------------------|
|id			|id provinsi yang ingin dicari, NOT NULL      |

**Success JSON Response** 
//success

## Search Cities<a name="search-cities"/>
Digunakan untuk mencari kota bagi user yang terotorisasi.

**Method**  <br />
GET http://127.0.0.1:8000/api/search/cities? <parameter\><br />

**Header**  <br />
Accept	: application/json <br />
Authorization	: bearer_token <br />

**Parameter** 
|Field Name    |Description             
|----------------|---------------------|
|id			|id kotayang ingin dicari, NOT NULL      |

**Success JSON Response** 
//success
