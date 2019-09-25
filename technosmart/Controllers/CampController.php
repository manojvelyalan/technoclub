<?php
namespace Technosmart\Controllers;
use Technosmart\Controllers\Controller as BaseController;
class CampController extends BaseController {

    public function contact($request,$response){
        $data = ['title' => "Home | Technosmart",
                'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                'navStatus'=>false,
            ];
        return $this->view->render($response,"camps/contact.twig",$data);
    }

    public function fulldaySummerCamp($request,$response){
        $data = [
                        'title' => "Summer Camp | Tech and Art Summer Camps",
                        'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                        'navStatus'=>false,
                    ];
        return $this->view->render($response,"camps/fulldaysummercamp.twig",$data);
    }
    
    public function halfdaySummerCamp($request,$response){
        $data = [
                        'title' => "Summer Camp | GAMING AND ANIMATION WITH SCRATCH",
                        'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                        'navStatus'=>false,
                    ];
        return $this->view->render($response,"camps/halfdaysummercamp.twig",$data);
    }
    public function gaming($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                        'title' => "Summer Camp | Gaming And Animation with Scratch (10-14 yrs.)",
                        'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                        'navStatus'=>false,
                        'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                        'url'=>$url
            
                    ];
        return $this->view->render($response,"camps/gaming.twig",$data);
    }
    public function art($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                        'title' => "Summer Camp | Computer Foundation with Art 1 (7-9 yrs.)",
                        'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                        'navStatus'=>false,
                        'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                        'url'=>$url
            
                    ];
        return $this->view->render($response,"camps/art.twig",$data);
    }
    public function art1($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                        'title' => "Summer Camp | Computer Foundation with Art 2 (7-9 yrs.)",
                        'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                        'navStatus'=>false,
                        'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                        'url'=>$url
            
                    ];
        return $this->view->render($response,"camps/art1.twig",$data);
    }
    public function python($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                        'title' => "Summer Camp | Python Coding",
                        'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                        'navStatus'=>false,
                        'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                        'url'=>$url
            
                    ];
        return $this->view->render($response,"camps/python.twig",$data);
    }
    public function imageediting($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | Photography and Image editing",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/photography.twig",$data);
    }
    public function ev($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | Robotics with Ev3",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/ev3.twig",$data);
    }
    public function youtubing($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | YouTubing: Video production and editing",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/youtubing.twig",$data);
    }
    public function drawing($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | Drawing Art by Young Rembrandts ",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/drawing.twig",$data);
    }
    public function fun($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | Fun with Science ",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/fun.twig",$data);
    }
    public function java($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | Java coding ",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/java.twig",$data);
    }
    public function adventures($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | Engineering Adventures(6-9yrs) ",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/adventures.twig",$data);
    }
    public function artblend($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | Art Blend ( 8 -11 yrs.) ",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/artblend.twig",$data);
    }
    public function cartoon($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | Cartoons N Characters - Drawing Workshop",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/cartoon.twig",$data);
    }
    public function fasion($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | Fashion Runway: Drawing Workshop (10-14 yrs.)",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/fasion.twig",$data);
    }
    public function artsmart($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | Art Smart – Drawing Workshop (9-14 yrs.)",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/artsmart.twig",$data);
    }
    public function introtoscratch($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | Gaming and Animation - Scratch Coding 1, Beginner",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/introtoscratch.twig",$data);
    }
    public function scratchcoding($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | SCRATCH Coding",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/scratchcoding.twig",$data);
    }
    public function scratchcoding2($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | Gaming and Animation - Scratch Coding 3, Advance",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/scratchcoding2.twig",$data);
    }
    public function python1($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | PYTHON CODING 1",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/python1.twig",$data);
    }
    public function python2($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | PYTHON CODING 2",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/python2.twig",$data);
    }
    public function java2($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | JAVA CODING  2 ",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/java2.twig",$data);
    }public function sewing($request,$response){
        $pageName = "";
        $url = $this->router->pathFor('halfdaysummercamp');
        $refererHeader = $request->getHeader('HTTP_REFERER');
        if(count($refererHeader) > 0){
            $url = $refererHeader[0];
            $URLArray = explode("/", $refererHeader[0]);
            echo $pageName = $URLArray[count($URLArray) - 1];
        }
        $data = [
                    'title' => "Summer Camp | Sewing N Craft",
                    'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                    'navStatus'=>false,
                    'pageName'=>($pageName === "fulldaysummercamp")?"Full Day Summer Camp":"Half Day Summer Camp",
                    'url'=>$url
            
                ];
        return $this->view->render($response,"camps/sewing.twig",$data);
    }
    public function campdescription($erquest, $response){
        $data = ['title'=>"Summer Camp | Camps Description",
            'description'=>'Half and Full days Tech camps for 6-14 yrs. Scratch, Python, Java Programming, Robotics, Photography, Digital Imaging, Art and craft, Drawing. Small camp size – Register Today!',
            
                
            ];
        
        return $this->view->render($response,"camps/campdescription.twig",$data);
    }
    
}
