<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    function LoadPng($imgname)
    {
        /* Attempt to open */
        $im = @imagecreatefrompng($imgname);

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

	function genPic($avatar, $toAvatar, $bg, $title, $description) {
		$dest = $this->LoadJpeg($bg);
		$src = $this->LoadJpeg($avatar);
        $srcToAvatar = $this->LoadJpeg($toAvatar);
        $framepath = app_path().'/assets/images/border.png';
        $frame = $this->LoadPng($framepath);

		$avatarPosX = 37;
		$avatarPosY = 265;

		//draw text
		$white = imagecolorallocate($dest, 255, 255, 255);
		$grey = imagecolorallocate($dest, 128, 128, 128);
		$black = imagecolorallocate($dest, 0, 0, 0);
		$yellow = imagecolorallocate($dest, 255, 255, 0);
        $red = imagecolorallocate($dest, 150, 0, 0);

		//The text to draw
		$text = $description;
		//$text = $this->wrapText($text, 45);
		// Replace path by your own font path
		// Set the enviroment variable for GD
		//putenv('GDFONTPATH=' . realpath('.'));
		putenv('GDFONTPATH='.app_path().'/assets/fonts/');
		$font = 'GRGAREF.TTF';
		$size = 16;
		$angle = 0;

		// $box = ImageTTFBBox($size, $angle, $font, $title);

		// $xr = abs(max($box[2], $box[4]));
		// $yr = abs(max($box[5], $box[7]));

		// // Add some shadow to the text
		// imagettftext($dest, 22, $angle, $textPosX - $xr/2 + 2, $textPosY+2, $black, $font, $title);

		// // Add the text
		// imagettftext($dest, 22, $angle, $textPosX - $xr/2, $textPosY, $white, $font, $title);

        $dimensions = imagettfbbox($size, 0, $font, $text);
        $margin = 10;
        $text = explode("\n", wordwrap($text, 40)); // <-- you can change this number
        $delta_y = 95;
        //Centering y
        $y = (imagesy($dest) - (($dimensions[1] - $dimensions[7]) + $margin)*count($text)) / 2;

        foreach($text as $line) {
            $dimensions = imagettfbbox($size, 0, $font, $line);
            $delta_y =  $delta_y + ($dimensions[1] - $dimensions[7]) + $margin;
            //centering x:
            $x = imagesx($dest) / 2 - ($dimensions[4] - $dimensions[6]) / 2;

            imagettftext($dest, $size, 0, $x, $y + $delta_y, $white, $font, $line);
        }

		//$box = ImageTTFBBox($size, $angle, $font, $text);

		//$xr2 = abs(max($box[2], $box[4]));
		//$yr2 = abs(max($box[5], $box[7]));

		//$totalW = $xr2;
		//$textPosX = 210;
		//$textPosY = 300;

		// Copy and merge
		imagecopymerge($dest, $src, $avatarPosX, $avatarPosY, 0, 0, 160, 160, 100);
        imagecopy($dest, $frame, $avatarPosX, $avatarPosY, 0, 0, 160, 160);
        imagecopymerge($dest, $srcToAvatar, 656, $avatarPosY, 0, 0, 160, 160, 100);
        imagecopy($dest, $frame, 656, $avatarPosY, 0, 0, 160, 160);

		// Add some shadow to the text
		//imagettftext($dest, $size, $angle, $textPosX + 2, $textPosY+ 2, $black, $font, $text);

		// Add the text
		//imagettftext($dest, $size, $angle, $textPosX, $textPosY, $white, $font, $text);

		$type = 'image/jpeg';

        $filename = uniqid().".jpg";
        $outputPath = app_path().'/assets/userphotos/';
        imagejpeg($dest, $outputPath.$filename);

		imagedestroy($dest);
		imagedestroy($src);

        return $filename;
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
        $invitationId = Input::get('invitationId', '');
        if ($invitationId == '') {
            $ret = array("status" => "error", "message"=>"Missing Invitation Id!");
            return Response::json($ret);
        }

        $invitation = Invitation::findOrFail($invitationId);
        App::error(function(ModelNotFoundException $e)
        {
            return Response::make('Not Found', 404);
        });

		$fromId = $invitation->from_id;
		$toId = $invitation->to_id;
		$title = Input::get('title', '');
		$description = Input::get('description', '');

		$avatar = "https://graph.facebook.com/".$fromId."/picture?type=large&width=160&height=160";
        $toAvatar = "https://graph.facebook.com/".$toId."/picture?type=large&width=160&height=160";
		$bg =  app_path().'/assets/images/banner.jpg';

		$filename = $this->genPic($avatar, $toAvatar, $bg, $title, $description);

        $photo = new Photo;
        $photo->invitation_id = $invitationId;
        $photo->file = $filename;
        $photo->save();

        if($photo->id) {
            $ret = array("status" => "success", "photo"=>$filename);
            return Response::json($ret);
        } else {
            $ret = array("status" => "error", "message"=>"Unknown!");
            return Response::json($ret);
        }
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