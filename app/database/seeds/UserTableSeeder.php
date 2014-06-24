<?php

use Carbon\Carbon;
class UserTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('users')->delete();

		DB::table('users')->insert(
			array(
				array(
					'fbid' => '100003095200864',
					'username' => 'tran.p.trung.1',
					'shortname' => 'TrầnTrung',
					'fullname' => 'Trần Phú Trung',
					'birthday' => Carbon::createFromDate(1996, 9, 30),
					'gender' => 'male',
					'place' => 'Hanoi, Vietnam',
					'email' => 'spiderman.tpt@gmail.com',
					'last_login_at' => null,
					'created_at' => null
				),
				array(
					'fbid' => '100004893194524',
					'username' => 'DangAnhTu97',
					'shortname' => 'ĐặngAnhTú',
					'fullname' => 'Đặng Anh Tú',
					'birthday' => Carbon::createFromDate(1997, 4, 3),
					'gender' => 'male',
					'place' => 'Yên Thành',
					'email' => 'danganhtu264@yahoo.com.vn',
					'last_login_at' => null,
					'created_at' => null
				),
				array(
					'fbid' => '100004436140939',
					'username' => 'thien.duong.1481',
					'shortname' => 'ThiệnDương',
					'fullname' => 'Thiện Dương',
					'birthday' => Carbon::createFromDate(1982, 8, 25),
					'gender' => 'male',
					'place' => 'Seoul, Korea',
					'email' => '',
					'last_login_at' => null,
					'created_at' => null
				),
				array(
					'fbid' => '100006692769463',
					'username' => 'nghiem.minhanh.7',
					'shortname' => 'KhởiPhấn',
					'fullname' => 'Phấn Khởi',
					'birthday' => Carbon::createFromDate(1995, 9, 6),
					'gender' => 'male',
					'place' => 'Hanoi, Vietnam',
					'email' => 'minhanh.nghiem@yahoo.com',
					'last_login_at' => null,
					'created_at' => null
				),
				array(
					'fbid' => '100004680511516',
					'username' => 'huydbsk2000',
					'shortname' => 'CôngHuy',
					'fullname' => 'Công Đào Huy',
					'birthday' => Carbon::createFromDate(2000, 5, 16),
					'gender' => 'male',
					'place' => 'Hanoi, Vietnam',
					'email' => 'huydbsk1@yahoo.com.vn',
					'last_login_at' => null,
					'created_at' => null
				),
				array(
					'fbid' => '573887907',
					'username' => 'cindy.d.chau',
					'shortname' => 'DangChau',
					'fullname' => 'Dang Chau',
					'birthday' => Carbon::createFromDate(1990, 2, 8),
					'gender' => 'female',
					'place' => 'Ho Chi Minh City, Vietnam',
					'email' => 'misscachep@yahoo.com',
					'last_login_at' => null,
					'created_at' => null
				)
			)
		);
	}

}
