<?php

class ItemsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('items')->truncate();

		$items = array(
			array(
				'name' => 'Spider-man #1',
				'description' => 'Một thiếu niên mồ côi sống cùng hai bác của mình. Trong một lần không để ý, cậu đã bị một con nhện biến đổi Gen cắn. Sau đó Peter có sức mạnh của loài nhện. Ở phần 2 này, Petter Parker quyết định dùng sức mạnh của mình để bảo vệ thành phố và những người yêu thương.',
				'file' => 'Card-1.png',
				'total_quantity' => 5,
				'current_quantity' => 5,
				'event_id' => 1,
				'created_at' => null
			),
			array(
				'name' => 'Spider-man #2',
				'description' => 'Một thiếu niên mồ côi sống cùng hai bác của mình. Trong một lần không để ý, cậu đã bị một con nhện biến đổi Gen cắn. Sau đó Peter có sức mạnh của loài nhện. Ở phần 2 này, Petter Parker quyết định dùng sức mạnh của mình để bảo vệ thành phố và những người yêu thương.',
				'file' => 'Card-2.png',
				'total_quantity' => 5,
				'current_quantity' => 5,
				'event_id' => 1,
				'created_at' => null
			),
			array(
				'name' => 'Electro #1',
				'description' => 'Một kỹ sư điện làm việc cho tập đoàn Oscorp. Một người luôn thần tượng và ám ảnh Người Nhện. Sau một tai nạn, Max Dillon rơi vào một thùng điện và bị lươn điện cắn, Max trở thành một người khác, điều khiển được điện và có sức mạnh vô song.',
				'file' => 'Card-3.png',
				'total_quantity' => 5,
				'current_quantity' => 5,
				'event_id' => 1,
				'created_at' => null
			),
			array(
				'name' => 'Green Goblin #1',
				'description' => 'Là bạn cũ của Peter và con trai của chủ tịch tập đoàn Oscorp Nornan Osborn, Harry Osborn. Cậu khám phá ra bí mật của tập đoàn Osborn và âm mưu của cha mình. Harry Osborn trở thành Green Goblin và muốn tiêu diệt Người Nhện.',
				'file' => 'Card-4.png',
				'total_quantity' => 5,
				'current_quantity' => 5,
				'event_id' => 1,
				'created_at' => null
			),
			array(
				'name' => 'Gwen Stacy #1',
				'description' => 'Gwen Stacy là một nữ sinh cấp 3 và cũng là người yêu của Peter. Cô biết thân phận thật của Peter/Người Nhện và luôn giúp đỡ anh.',
				'file' => 'Card-5.png',
				'total_quantity' => 5,
				'current_quantity' => 5,
				'event_id' => 1,
				'created_at' => null
			),
			array(
				'name' => 'Rhino',
				'description' => 'Là một tên cướp người Nga. Nhưng sau đó nhờ sức mạnh của Tập đoàn Oscorp, hắn trở thành Rhino với một mục tiêu duy nhất là tiêu diệt Người Nhện.',
				'file' => 'Card-6.png',
				'total_quantity' => 5,
				'current_quantity' => 5,
				'event_id' => 1,
				'created_at' => null
			),
			array(
				'name' => 'May Reilly Parker',
				'description' => 'Dì May là người đã nuôi dưỡng Peter từ nhỏ. Dì là người có ảnh hưởng lớn đến Peter, bà luôn ủng hộ và giúp Peter. Mặc dù vậy, dì không biết được cháu mình lại là một siêu anh hùng luôn bảo vệ mọi người trước những thế lực đen tối.',
				'file' => 'Card-7.png',
				'total_quantity' => 5,
				'current_quantity' => 5,
				'event_id' => 1,
				'created_at' => null
			),
			array(
				'name' => 'Electro #2',
				'description' => 'Một kỹ sư điện làm việc cho tập đoàn Oscorp. Một người luôn thần tượng và ám ảnh Người Nhện. Sau một tai nạn, Max Dillon rơi vào một thùng điện và bị lươn điện cắn, Max trở thành một người khác, điều khiển được điện và có sức mạnh vô song.',
				'file' => 'Card-8.png',
				'total_quantity' => 5,
				'current_quantity' => 5,
				'event_id' => 1,
				'created_at' => null
			),
			array(
				'name' => 'Peter Parker',
				'description' => 'Một thiếu niên mồ côi sống cùng hai bác của mình. Trong một lần không để ý, cậu đã bị một con nhện biến đổi Gen cắn. Sau đó Peter có sức mạnh của loài nhện. Ở phần 2 này, Petter Parker quyết định dùng sức mạnh của mình để bảo vệ thành phố và những người yêu thương.',
				'file' => 'Card-9.png',
				'total_quantity' => 5,
				'current_quantity' => 5,
				'event_id' => 1,
				'created_at' => null
			),
			array(
				'name' => 'Harry Osborn',
				'description' => 'Là bạn cũ của Peter và con trai của chủ tịch tập đoàn Oscorp Nornan Osborn, Harry Osborn. Cậu khám phá ra bí mật của tập đoàn Osborn và âm mưu của cha mình. Harry Osborn trở thành Green Goblin và muốn tiêu diệt Người Nhện.',
				'file' => 'Card-10.png',
				'total_quantity' => 5,
				'current_quantity' => 5,
				'event_id' => 1,
				'created_at' => null
			),
			array(
				'name' => 'Gwen Stacy #2',
				'description' => 'Gwen Stacy là một nữ sinh cấp 3 và cũng là người yêu của Peter. Cô biết thân phận thật của Peter/Người Nhện và luôn giúp đỡ anh.',
				'file' => 'Card-11.png',
				'total_quantity' => 5,
				'current_quantity' => 5,
				'event_id' => 1,
				'created_at' => null
			),
			array(
				'name' => 'Spider-man #3',
				'description' => 'Một thiếu niên mồ côi sống cùng hai bác của mình. Trong một lần không để ý, cậu đã bị một con nhện biến đổi Gen cắn. Sau đó Peter có sức mạnh của loài nhện. Ở phần 2 này, Petter Parker quyết định dùng sức mạnh của mình để bảo vệ thành phố và những người yêu thương.',
				'file' => 'Card-12.png',
				'total_quantity' => 5,
				'current_quantity' => 5,
				'event_id' => 1,
				'created_at' => null
			),
			array(
				'name' => 'Green Goblin #2',
				'description' => 'Là bạn cũ của Peter và con trai của chủ tịch tập đoàn Oscorp Nornan Osborn, Harry Osborn. Cậu khám phá ra bí mật của tập đoàn Osborn và âm mưu của cha mình. Harry Osborn trở thành Green Goblin và muốn tiêu diệt Người Nhện.',
				'file' => 'Card-13.png',
				'total_quantity' => 5,
				'current_quantity' => 5,
				'event_id' => 1,
				'created_at' => null
			),
			array(
				'name' => 'Spider-man #4',
				'description' => 'Một thiếu niên mồ côi sống cùng hai bác của mình. Trong một lần không để ý, cậu đã bị một con nhện biến đổi Gen cắn. Sau đó Peter có sức mạnh của loài nhện. Ở phần 2 này, Petter Parker quyết định dùng sức mạnh của mình để bảo vệ thành phố và những người yêu thương.',
				'file' => 'Card-14.png',
				'total_quantity' => 5,
				'current_quantity' => 5,
				'event_id' => 1,
				'created_at' => null
			),
			array(
				'name' => 'Spider-man #5',
				'description' => 'Một thiếu niên mồ côi sống cùng hai bác của mình. Trong một lần không để ý, cậu đã bị một con nhện biến đổi Gen cắn. Sau đó Peter có sức mạnh của loài nhện. Ở phần 2 này, Petter Parker quyết định dùng sức mạnh của mình để bảo vệ thành phố và những người yêu thương.',
				'file' => 'Card-15.png',
				'total_quantity' => 5,
				'current_quantity' => 5,
				'event_id' => 1,
				'created_at' => null
			)
		);

		// Uncomment the below to run the seeder
		DB::table('items')->insert($items);
	}

}
