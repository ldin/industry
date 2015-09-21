<?php

class HomeController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |   Route::get('/', 'HomeController@showWelcome');
    |
    */
    protected function setupLayout()
    {
        $type_page=Type::where('status',1)->get(array('id', 'name', 'type', 'template'));
        $type_child = Post::where('status',1)->where('parent', '=',0)->orderBy('created_at', 'desc')->get(array('type_id', 'name', 'slug'));

        View::share([
            'type_page'=>$type_page,
            'type_child'=>$type_child,
        ]);
    }

    public function showWelcome()
    {
        return View::make('home.index');
    }

    public function getPage($type, $cat_slug=''){

        $type_post = Type::where('type', $type)->first();
        $posts_child = $galleries = $posts = $items = $row = $subcategory = array();

        if(empty($type_post)){
            return Response::view('errors.not-found')->header('Content-Type',  '404 Not Found');
        }

        if($type_post->template=='gallery'){
            $row = Post::where('slug', $type)->first();
            $type_post = Type::where('id', $row->type_id)->first();
            $galleries = Gallery::where('post_id', $row->id)->get();
        }

        else if($type_post->template=='category'){
            if($cat_slug==''){
                $row = $type_post;
                $posts = Post::where('type_id',$type_post->id)->where('status',1)->where('parent', 0)->orderBy('created_at', 'desc')->get();
            }
            else{    
                $row = Post::where('slug', $cat_slug)->first();
                $posts = Post::where('type_id',$type_post->id)->where('status',1)->where('parent',$row->id)->orderBy('created_at', 'desc')->get();
                $items = Product::where('status',1)->where('post_id', $row->id)->get();
            }
        }

        else{
            
            $posts = Post::where('type_id',$type_post->id)->where('status',1)->where('parent',0)->orderBy('created_at', 'desc')->get();
            $posts_child = Post::where('type_id',$type_post->id)->where('status',1)->where('parent', '!=',0)->orderBy('created_at', 'desc')->get();

            if($type_post->template=='news'){
                if($cat_slug==''){
                    $subcategory = Post::where('type_id',$type_post->id)->where('status',1)->where('parent','!=',0)->orderBy('created_at', 'desc')->paginate(15);
                }else{
                    $row = Post::where('slug', $cat_slug)->first();            
                    $subcategory = Post::where('type_id',$type_post->id)->where('status',1)->where('parent', $row->id)->orderBy('created_at', 'desc')->paginate(15);
                }

                foreach ($subcategory as $key => $post) {
                    $preview = HomeController::previewFirstSimbol($post->text, 500);
                    $post->preview = $preview['text'];
                    $post->preview_img = $preview['img'];
                }
            }

            if($cat_slug!=''){
                $row = Post::where('slug',$cat_slug)->first();
                if($row->parent!=0){
                    $parent = Post::where('id',$row->parent)->first();
                    $row->parent_title=$parent->name;
                    $row->parent_slug=$parent->slug;
                }

                $galleries = Gallery::where('post_id', $row->id)->get();
            }
        }

        $view = array(
            'type'=>$type_post,
            'posts'=>$posts,
            'subcategory'=>$subcategory,
            'posts_child' => $posts_child,            
            'row' => $row,
            'items' => $items,
            'galleries' => $galleries,
        );
        return View::make('home.'.$type_post->template, $view);
    } 


    public function getItem($type, $cat_slug, $item_slug){

        $type_post = Type::where('type', $type)->first();
        $posts_child = $galleries = $posts = $items = $row = $subcategory = array();

        if(empty($type_post)){
            return Response::view('errors.not-found')->header('Content-Type',  '404 Not Found');
        }

        $category =  Post::where('slug', $cat_slug)->first();
        $row = Product::where('post_id', $category->id)->where('slug', $item_slug)->first();
        $attributes = Attribute::lists('value', 'id');

        $view = array(
            'type'=>$type_post,
            'posts'=>$posts,
            'subcategory'=>$subcategory,
            'posts_child' => $posts_child,            
            'row' => $row,
            'attributes' => $attributes,
            'galleries' => $galleries,
        );
        return View::make('home.item', $view);
    }

    //превью новостей (первые $count символов из $data)
    public function previewFirstSimbol($data, $count){
        $first_img = $text = NULL;
        if(!empty($data)){
            for($i=1; $i<4; $i++ )  {

                preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $data, $matches);  
                                           
                if(isset($matches[1][0])){
                    $first_img = $matches[1][0];
                } 
                else{
                    $first_img = null;
                }

                $txt = strip_tags($data); 
                $txt = substr($txt, 0, $count);
                $txt = substr($txt, 0, strrpos($txt, ' ' ));                
                $text = $txt.'...';                             
            }
        }
        $preview = array(
            'text' => $text,
            'img' => $first_img
        );                              
            
        return $preview;             
    }

    public function postFormRequest()
    {
            $all = Input::all();

            $rules = array(
                // 'name' => 'required|min:2|max:255',
            );

            $validator = Validator::make($all, $rules);
            if ( $validator -> fails() ) {
                return Redirect::to('/#contact')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('errorRequest', 'Ошибка');
            }

            $post = new Requests();
            $post->name = $all['name'];
            $post->phone = $all['phone'];
            $post->email = $all['email'];
            $post->text = $all['text'];
            $post->save();

            // $mail = Setting::where('name', 'email')->first('value');
            // $mail = 'ldin04ka@mail.ru';
            $mail = 'sovet.consul@gmail.com';
             //var_dump($mail->value); die();

            $messages = '<b>Пользователь: </b>'.$all['name'].'<br>';
            $messages .= '<b>Вопрос: </b>'.$all['text'].'<br>';
            $messages .= '<b>Контактные данные: </b>'.'<br>';
            $messages .= '<i>Телефон: </i>'.$all['phone'].'<br>';
            $messages .= '<i>Емайл: </i>'.$all['email'].'<br>';

                Mail::send('emails.message',
                    array('messages' => $messages ),
                    function ($message) use ($mail)  {
                        $message->to($mail)->subject('Обращение посетителя');
                    }
                );

            return Redirect::to('/#contact')
                    ->with('successRequest', 'Сообщение отправлено');
    }

    public function autocomplete($type, $street_id=''){
        $term = Input::get('term');

        $results = array();

        if($type == 'street'){

            $queries = DB::connection('mysql_address')->table('common_street')
                ->where('name', 'LIKE', '%'.$term.'%')
                ->select('name', 'id')
                ->take(5)->get();
            foreach ($queries as $query)
                {
                    $results[] = [ 'id' => $query->id, 'value' => $query->name ];
                }


        }
        else if($type == 'house'){
            $queries = DB::connection('mysql_address')->table('common_house')
                ->where('street', $street_id)
                ->where('house', 'LIKE', '%'.$term.'%')
                ->select('house as name', 'id', 'flag_t', 'flag_p' )
                ->take(5)->get();

            foreach ($queries as $query)
            {
                $results[] = [ 'id' => $query->id, 'value' => $query->name, 'flag'=>$query->flag_t ];
            }
        }
        else{
            return false;
        }


        // var_dump($results); die();
    return Response::json($results);
    }


    public function getRate($slug=''){

        $type=Type::where('type', 'rate')->first();
        $posts = Post::where('type_id', '=', $type->id)->where('status',1)->where('parent', '=', '0')->orderBy('created_at', 'desc')->get();
        $posts_child = Post::where('type_id', '=', $type->id)->where('status',1)->where('parent', '!=', '0')->orderBy('created_at', 'desc')->get();
        // var_dump($slug);
        if(!empty($slug)){
            $row = Post::where('slug', $slug)->first();
            $posts_child = Post::where('type_id', '=', $type->id)->where('parent', $row->id)->where('status',1)->orderBy('created_at', 'desc')->get();
            $blade = 'home.page-menu-title';
        }
        else{
            $tv = Rate::where('type', 'tv')->where('status', 1)->orderBy('position', 'asc')->get();
            $inet = Rate::where('type', 'inet')->first();
            $inetOption = Rate::where('type', 'inetOption')->where('status', 1)->orderBy('position', 'asc')->get();
            $row = array(
                'inet'=>json_decode($inet->description),
                'inetOption'=>$inetOption,
                'tv'=>$tv,
            );
            $blade = 'home.page-rate';
        }

        $view = array(
            'posts' => $posts,
            'posts_child' => $posts_child,
            'type' => $type,
            'row'=> $row,
        );
        return View::make($blade, $view);
    }

    public function postConnect( $slug=''){
        var_dump(Input::all());die();


        $view = array(

        );
        return View::make('home.index', $view);
    }
}
