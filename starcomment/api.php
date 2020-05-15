//สร้าง controller ก่อน หรือใช้ controller ที่มีอยู่แล้ว
Route::post('giveStar', 'API\PostRatingController@giveStar');
Route::get('starScore/{id}', 'API\PostRatingController@starScore');
