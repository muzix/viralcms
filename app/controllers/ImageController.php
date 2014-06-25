<?php

class ImageController extends \BaseController {

	function LoadJpeg($imgname)
	{
	    /* Attempt to open */
	    $im = @imagecreatefromjpeg($imgname);

	    /* See if it failed */
	    if(!$im)
	    {
	        /* Create a black image */
	        $im  = imagecreatetruecolor(150, 30);
	        $bgc = imagecolorallocate($im, 255, 255, 255);
	        $tc  = imagecolorallocate($im, 0, 0, 0);

	        imagefilledrectangle($im, 0, 0, 150, 30, $bgc);

	        /* Output an error message */
	        imagestring($im, 1, 5, 5, 'Error loading ' . $imgname, $tc);
	    }

	    return $im;
	}

	function wrapText($description,$maxLenPerLine) {
		$len=strlen($description);
		$str="";
		$c=0;
		for($i=0;$i<$len;$i++){
			$chr=substr($description,$i,1);
			$str.=$chr;
			if($c>$maxLenPerLine && $chr==" ") {
				$str.="\n";
				$c=0;   
			}
			$c++;
			}
		$result=$str;
		return $result;
	}

	function genPic($avatar, $bg, $title, $description) {
		$dest = $this->LoadJpeg($bg);
		$src = $this->LoadJpeg($avatar);

		$avatarPosX = 220;
		$avatarPosY = 60;
		$textPosX = 810 * 0.5 - 50;
		$textPosY = 40;

		//draw text
		$white = imagecolorallocate($dest, 255, 255, 255);
		$grey = imagecolorallocate($dest, 128, 128, 128);
		$black = imagecolorallocate($dest, 0, 0, 0);
		$yellow = imagecolorallocate($dest, 255, 255, 0);

		// The text to draw
		// $text = $description;
		// $text = $this->wrapText($text, 100);
		// // Replace path by your own font path
		// // Set the enviroment variable for GD
		// //putenv('GDFONTPATH=' . realpath('.'));
		// putenv('GDFONTPATH=/assets');
		// $font = 'GRGAREF.TTF';
		// $size = 16;
		// $angle = 0;

		// $box = ImageTTFBBox($size, $angle, $font, $title);

		// $xr = abs(max($box[2], $box[4]));
		// $yr = abs(max($box[5], $box[7]));

		// // Add some shadow to the text
		// imagettftext($dest, 22, $angle, $textPosX - $xr/2 + 2, $textPosY+2, $black, $font, $title);

		// // Add the text
		// imagettftext($dest, 22, $angle, $textPosX - $xr/2, $textPosY, $white, $font, $title);


		// $box = ImageTTFBBox($size, $angle, $font, $text);

		// $xr2 = abs(max($box[2], $box[4]));
		// $yr2 = abs(max($box[5], $box[7]));

		// $totalW = $xr2 + 94;
		// $avatarPosX = 810 * 0.5 - $totalW * 0.5;
		// $textPosX = $avatarPosX + 94;
		// $textPosY = $avatarPosY + 42;

		// Copy and merge
		imagecopymerge($dest, $src, $avatarPosX, $avatarPosY, 0, 0, 84, 84, 100);

		// Add some shadow to the text
		//imagettftext($dest, $size, $angle, $textPosX + 2, $textPosY+ 2, $black, $font, $text);

		// Add the text
		//imagettftext($dest, $size, $angle, $textPosX, $textPosY, $white, $font, $text);

		$type = 'image/jpeg';

	    return Response::make($dest, 200, 
	                        array(
	                        'Content-Type'              => $type,
	                        'Content-Transfer-Encoding' => 'binary',
	                        'Content-Disposition'       => 'inline',
	                        'Expires'                   => 0,
	                        'Cache-Control'             => 'must-revalidate, post-check=0, pre-check=0',
	                        'Pragma'                    => 'public',
	                     
	                        ))->header();
        imagejpeg($dest);

		imagedestroy($dest);
		imagedestroy($src);
	}

	/**
	 * Display a listing of the resource.
	 * GET /image
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /image/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$fromId = Input::get('fromId', '');
		$toId = Input::get('toId', '');
		$title = Input::get('title', '');
		$description = Input::get('description', '');

		$avatar = "http://graph.facebook.com/".$fromId."/picture?type=large&width=84";
		$bg = '/assets/like.jpg';

		$this->genPic($avatar, $bg, $title, $description);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /image
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /image/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /image/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /image/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /image/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}