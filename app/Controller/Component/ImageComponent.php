<?php
/**
 * Component for working with image.
 
 */

class ImageComponent extends Component {
	


function  create_watermark($source_file_path,$watermark_overlay_image,$type='',$watermark_type){

	$watermark_overlay_opacity=50;
	
	$watermark_output_quality=90;
	
	

    list($source_width, $source_height, $source_type) = getimagesize($source_file_path);

    if ($source_type === NULL) {
        return false;
    }

    switch ($source_type) {

        case IMAGETYPE_GIF:

            $source_gd_image = imagecreatefromgif($source_file_path);

            break;

        case IMAGETYPE_JPEG:
           
		    $source_gd_image = imagecreatefromjpeg($source_file_path);
           
		    break;
       
	    case IMAGETYPE_PNG:
        
		    $source_gd_image = imagecreatefrompng($source_file_path);
          
		    break;
       
	    default:
            return false;
    }
    
	$overlay_gd_image = imagecreatefrompng($watermark_overlay_image);
    
	$overlay_width = imagesx($overlay_gd_image);
   
    $overlay_height = imagesy($overlay_gd_image);
    
	if($watermark_type=='banner'){
		
		if($type=='admin'){

			$dst_x=10;
			$dst_y=0;
		
		}else{
			
			$dst_x=$source_width - $overlay_width;
			$dst_y=$source_height - $overlay_height;
			
		}
	
	}else{
		
		
			if($type=='admin'){
			
			$dst_x=10;
			$dst_y=$source_height - $overlay_height - 20;
			
			}else{
			
			$dst_x=$source_width - $overlay_width - 10;
			$dst_y=$source_height - $overlay_height - 20;
			
			}
	
	}
	
	
	
	
	//imagecopy($source_gd_image,$overlay_gd_image,$dst_x,$dst_y,0,0,$overlay_width,$overlay_height);
	
	imagecopy($source_gd_image,$overlay_gd_image,$dst_x,$dst_y,0,0,$overlay_width,$overlay_height);
	
	
   
    imagejpeg($source_gd_image, $source_file_path, $watermark_output_quality);
    
	imagedestroy($source_gd_image);
  
    imagedestroy($overlay_gd_image);
	
	/*Unlink dynamically created venue watermark image*/
	if($watermark_type=='banner' && $type!='admin')
	@unlink($watermark_overlay_image);
}

	

function resize_png_image($img,$newWidth,$newHeight,$target)
		{
			$srcImage=imagecreatefrompng($img);
			if($srcImage==''){
				return FALSE;
			}
			$srcWidth=imagesx($srcImage);
			$srcHeight=imagesy($srcImage);
			$percentage=(double)$newWidth/$srcWidth;
			$destHeight=round($srcHeight*$percentage)+1;
			$destWidth=round($srcWidth*$percentage)+1;
		
			$destImage=imagecreatetruecolor($destWidth-1,$destHeight-1);
			if(!imagealphablending($destImage,FALSE)){
				return FALSE;
			}
			if(!imagesavealpha($destImage,TRUE)){
				return FALSE;
			}
			if(!imagecopyresampled($destImage,$srcImage,0,0,0,0,$destWidth,$destHeight,$srcWidth,$srcHeight)){
				return FALSE;
			}
			if(!imagepng($destImage,$target)){
				return FALSE;
			}
			imagedestroy($destImage);
			imagedestroy($srcImage);
			return TRUE;
		}


}