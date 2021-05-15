<?php


//Default
App::get('/',false);
App::get('/default/contactus', false);
App::get('/default/detail/([\d]+)', true);
App::get('/default/login', false);


//Client pages
App::get('/client/login', false);
App::get('/client/logout', true);
App::get('/client/dashboard', true);
App::get('/client/statistics', true);
App::get('/client/notification', true);
App::get('/client/rooms', true);
App::get('/client/room', true);

App::post('/client/centigrade',true);
App::post('/client/login', false);



//Admin Pages
App::get('/admin/dashboard', true);
App::get('/admin/adduser', true);
App::get('/admin/users', true);
App::get('/admin/edituser/([\d]+)', true);
App::get('/admin/editroom/([\d]+)', true);
App::get('/admin/logout', true);
App::get('/admin/login', false);

// User operation
App::post('/admin/login', false);
App::post('/admin/edituser', true);
App::post('/admin/adduser', true);
App::post('/admin/saveuser', true);
App::post('/admin/deleteuser', true);

// Room operation
App::post('/admin/getroom', true);
App::post('/admin/addroom', true);
App::post('/admin/deleteroom', true);
// in-Room operation
App::post('/admin/getdevices', true);
App::post('/admin/adddevice', true);
App::post('/admin/deletedevice', true);
App::post('/admin/getsockets', true);
App::post('/admin/addsocket', true);
App::post('/admin/deletesocket', true);








?>