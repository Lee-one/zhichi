<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Gregwar\Captcha\CaptchaBuilder;

use Config;
use App\Model\GoodsClass;
use App\Model\Type;
use App\Model\GoodsImages;


class PublicController
{
    /**
     * 验证码
     */
    public function code() {
        $builder = new CaptchaBuilder;

        $builder->build();

        $builder->buildAgainstOCR(100, 40);

        $response = \Response::make( $builder->output() );

        $response->header('Content-Type', 'image/png');

        \Session::put('imageCode', $builder->getPhrase());

        return $response;
    }


    /**
     * 发送邮箱
     */
    public function sendEmail(Request $request)
    {
        $code = substr(mt_rand(), 1, 4);
        $data = ['email'=>$request->get('email'), 'code' => $code];
        \Session::put('emailCode', $code);
        \Mail::send('activemail', $data, function($message) use($data)
        {
            $message->to($data['email'], '优品商家注册')->subject('优品！');
        });
        return response()->json(['state' => 200]);
    }


    /**
     * post 获取商品分类子级
     */
    public function ajaxGoodsclassSon(Request $request)
    {
        $result = GoodsClass::where('gc_parent_id', $request->get('id'))->get();
        $state = count($result) > 0 ? 200 : 0;
        return response()->json(['data' => $result, 'state' => $state]);
    }


    /**
     * post 获取类型
     */
    public function ajaxGoodsClassType(Request $request)
    {
        $result = Type::where('class_id', $request->get('id'))->get();
        $state = count($result) > 0 ? 200 : 0;
        return response()->json(['data' => $result, 'state' => $state]);
    }


    /**
     * 上传图片
     */
    public function uploadImg(Request $request)
    {
        // return response()->json(['state' => 0, 'message' => $request->all() ]);
        // if (!$request->hasFile('image')) {
        //     return response()->json(['state' => 0, 'message' => '上传文件为空!']);
        // }
        include 'Controller.php';
        $con = new controller();
        $file = $request->file("image");
        // if(!$file->isValid()){
        //     return response()->json(['state' => 0, 'message' => '上传文件出错!']);
        // }
        
        $path = $con->setImageUrl();//获取七牛云图片显示地址前缀
        $url = Config::get('cloudsystem.UPLOAD_URL');
        $code = $request->get('code');

        if ( !isset($url[ $code ]) ) {
            return response()->json(['state' => 0, 'message' => '上传参数错误!']);
        }

        $inNewName = array();

        if ( is_object($file) && count($file) == 1 ) {
            $isArray = 1;
            $originalName = $file->getFileName();
            $extension = $file->getClientOriginalExtension(); //上传文件的后缀.
            $newName = md5Rturn() . '.' . $extension;
            $inNewName[] = $newName;
            $size = $file->getSize();
            // $path = $url[$code] . substr($newName, 0, 1).'/';
            // $urlArray[] = '/'.$path.$newName;
            $urlArray[] = $path.'/'.$newName;
            //$file->move($path, $newName)
            //图片保存至七牛
            if ( ! $con->Uploade($newName,$file->getRealPath())) {
                return response()->json(['state' => 0, 'message' => '保存文件失败！']);
            }

        } else if ( count($file) >= 1 ) {
            if (count($file) > 8) {
                return response()->json(['state' => 0, 'message' => '最多只允许上传8张！']);
            }
            $isArray = 2;
            foreach ($file as $key => $value) {
                $originalName[] = $value->getFileName();
                $extension = $value->getClientOriginalExtension(); //上传文件的后缀.
                $newName = md5Rturn() . '.' . $extension;
                $inNewName[] = $newName;
                $size = $value->getSize();
                // $path = $url[$code] . substr($newName, 0, 1).'/';
                // $urlArray[] = '/'.$path.$newName;
                $urlArray[] = $path.'/'.$newName;
                if ( !$con->Uploade($newName,$value->getRealPath()) ) {
                    return response()->json(['state' => 0, 'message' => '保存文件失败！']);
                }
            }
            
        } else {
            return response()->json(['state' => 0, 'message' => '上传文件为空!']);
        }

        // $extension = $file->getClientOriginalExtension(); //上传文件的后缀.
        // $newName = md5Rturn() . '.' . $extension;
        // $size = $file->getSize();
        // $path = $url[$code] . substr($newName, 0, 1).'/';
        // if ( !$file->move($path, $newName) ) {
        //     return response()->json(['state' => 0, 'message' => '保存文件失败！']);
        // }
        

        if ( $code == 'goods' && $request->get('store_id') ) {
            if ( count($inNewName) > 0 ) {
                foreach ($inNewName as $v) {
                    $data[] = array(
                        'shop_id' => $request->get('store_id'),
                        'goods_id' => $request->get('goods_id'),
                        'image' => $v
                    );
                }
                GoodsImages::insert( $data );
            }
        }

        $info = array(
            'is_array' => $isArray,
            'originalName' => $originalName,
            'name' => $inNewName,
            'url' => $urlArray,
            'size' => $size,
            'type' => $extension,
            'state' => 'SUCCESS'
        );

       return response()->json(['data' => $info, 'state' => '200']);
    }


    /**
     * 自动生成后台路由和后台控制器-方法
     */
    public function generateRoute() {
        $routeArray = array('index', 'create', 'store', 'show', 'edit', 'update', 'destroy');
        $result = \App\Menu::orderBy('listorder', 'asc')->orderBy('parentid', 'asc')->where('parentid', 0)->get()->toArray();

        foreach ($result as $value) {

            $son = \App\Menu::orderBy('listorder', 'asc')->orderBy('parentid', 'asc')->where('parentid', $value['id'])->get()->toArray();

            if ( $son ) {
                $routeStr = "<?php\n\n";
                $actionStr = '';
                foreach ($son as $k => $v) {
                    $app    = strtolower( $v['app'] );
                    $group  = strtolower( $v['group'] );
                    $model  = strtolower( $v['model'] );
                    $action = $v['action'];
                    $uapp   = ucfirst( $v['app'] );
                    $ugroup = ucfirst( $v['group'] );
                    $umodel = ucfirst( $v['model'] );

                    $sonThree = \App\Menu::orderBy('listorder', 'asc')->orderBy('parentid', 'asc')->where('parentid', $v['id'])->get()->toArray();

                    if ($sonThree) {
                        $ri = 1;
                        foreach ($sonThree as $kt => $vt) {
                            $tapp    = strtolower( $vt['app'] );
                            $tgroup  = strtolower( $vt['group'] );
                            $tmodel  = strtolower( $vt['model'] );
                            $taction = $vt['action'];
                            $tuapp   = ucfirst( $vt['app'] );
                            $tugroup = ucfirst( $vt['group'] );
                            $tumodel = ucfirst( $vt['model'] );

                            // 路由信息
                            // if ($v['data'] == 'all' && in_array($taction, $routeArray)) {
                            //     if ($ri == 1)
                            //         $routeStr .= "Route::resource('/{$tapp}/{$tmodel}', '{$tuapp}\\{$tugroup}\\{$tumodel}Controller');\n\n";
                            //     $ri++;
                            // } else {
                                $isId = $vt['data'] == 'id' ? '/{id}' : '';
                                $routeStr .= '// '.$vt['name']."\n";
                                $routeStr .= "Route::{$vt['get']}('{$tapp}/{$tmodel}/{$taction}{$isId}', '{$tuapp}\\{$tugroup}\\{$tumodel}Controller@{$taction}');\n\n";
                            // }

                            // 方法信息
                            switch ($vt['data']) {
                                case 'id':
                                    $paramStr = '$id';
                                    break;
                                case 'request':
                                    $paramStr = 'Request $request';
                                    break;
                                default:
                                    $paramStr = 'Request $request, $id';
                                    break;
                            }
                            $actionStr .= "\t/*\n\t * ".$vt['name']."\n\t */"."\n";
                            $actionStr .= "\tpublic function {$taction}({$paramStr}) {\n\t\t";
                            $actionStr .= "return View::make(ADMINSTYLE.'{$tgroup}.{$tmodel}_{$taction}');";
                            $actionStr .= "\n\t}\n\n\n";


                            // 模板信息
                            $viewStr = '';

                            $viewStr .= "@include('admin.default.common.head')\n"
                            . "\t<div class=\"ibox-title son-btn\">\n"
                                . "\t\t<h5>所有项目</h5>\n"
                                . "\t\t<div class=\"ibox-tools\">\n"
                                    . "\t\t\t{!! actionBtn() !!}\n"
                                . "\t\t</div>\n"
                            . "\t</div>\n";

                            $pathView = base_path()."/resources/views/admin/default/{$tgroup}";
                            if ( !is_readable( $pathView ) ) {
                                is_file($pathView) or mkdir($pathView, 0744);
                            }

                            file_put_contents( "{$pathView}/{$tmodel}_{$taction}.blade.php", $viewStr);
                        }
                    } else {

                        // 路由信息
                        $isId = $v['data'] == 'id' ? '/{id}' : '';
                        $routeStr .= '// '.$v['name']."\n";
                        $routeStr .= "Route::get('{$app}/{$model}/{$action}{$isId}', '{$uapp}\\{$ugroup}\\{$umodel}Controller@{$action}');\n\n";

                        // 方法信息
                        $actionStr .= "\t/*\n\t * ".$v['name']."\n\t */"."\n";
                        $actionStr .= "\tpublic function {$action}() {\n\t\t";
                        $actionStr .= "return View::make(ADMINSTYLE.'{$group}.{$model}_{$action}');";
                        $actionStr .= "\n\t}\n\n\n";


                        // 模板信息
                        $viewStr = '';

                        $viewStr .= "@include('admin.default.common.head')\n"
                        . "\t<div class=\"ibox-title son-btn\">\n"
                            . "\t\t<h5>所有项目</h5>\n"
                            . "\t\t<div class=\"ibox-tools\">\n"
                                . "\t\t\t{!! actionBtn() !!}\n"
                            . "\t\t</div>\n"
                        . "\t</div>\n";

                        $pathView = base_path()."/resources/views/admin/default/{$group}";
                        if ( !is_readable( $pathView ) ) {
                            is_file($pathView) or mkdir($pathView, 0744);
                        }

                        file_put_contents( "{$pathView}/{$model}_{$action}.blade.php", $viewStr);
                    }
                    
                
                    file_put_contents( app_path()."/Http/Routes/{$ugroup}Route.php", $routeStr);

                    // 控制器信息
                    $pathController = app_path()."/Http/Controllers/Admin/{$ugroup}";
                    if (!is_dir( $pathController )) {
                        mkdir($pathController, 0744);
                    }

                    // if ( !is_readable( $pathController ) ) {
                    //     is_file($pathController) or mkdir($pathController, 0744);
                    // }
                    $controllerStr = "<?php\n\n";
                    $controllerStr .= "namespace App\Http\Controllers\Admin\\{$ugroup};\n\n";
                    $controllerStr .= "use Illuminate\Http\Request;\n\n";
                    $controllerStr .= "use App\Http\Requests;\n";
                    $controllerStr .= "use App\Http\Controllers\Controller;\n\n";
                    $controllerStr .= "use View;\n\n";
                    $controllerStr .= "class {$umodel}Controller extends Controller\n";
                    $controllerStr .= "{\n{$actionStr}\n}";
                    file_put_contents( "{$pathController}/{$umodel}Controller.php", $controllerStr);
                }
            }
        }
    }
}
