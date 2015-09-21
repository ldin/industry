<?php

class AdminController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    protected function setupLayout()
    {
        $type_page=Type::lists('name', 'id');

        View::share([
            'type_page'=>$type_page,
        ]);
    }

    public function getIndex()
    {

        $view = array(
         );
        return View::make('admin.index', $view);
    }



    public function getContent($type_id='content', $id='edit'){

        if($type_id=='content' && $id=='edit'){
            $posts = Type::orderBy('created_at', 'desc')->get();
            return View::make('admin.content')->with('posts', $posts);
        }

        $posts = Post::where('type_id', '=', $type_id)->where('parent', '=', '0')->orderBy('created_at', 'desc')->get();
        $posts_child = Post::where('type_id', '=', $type_id)->where('parent', '!=', '0')->orderBy('created_at', 'desc')->get();

        $view = array(
            'posts' => $posts,
            'posts_child' => $posts_child,
            'type_id' => $type_id,
         );

        $templates = array(
                'gallery'=>'Галлерея',
                'page'=>'Текст',
                'category'=>'Категория товаров',
                'news'=>'Новости',
        );

        //добавляем категорию
        if($type_id=='type' && $id=='add'){
              $view['templates'] = $templates;
            return View::make('admin.catalog.post-type', $view);
        }
        
        //редактируем категорию
        if($id=='edit'){
            $post = Type::where('id', $type_id)->first();

            $view['row'] = $post;
            $view['templates'] = $templates;
            return View::make('admin.catalog.post-type', $view);
        }

        //добавляем или редактируем страницу
        else if(is_numeric($id)||$id=='add'){
            $post = Post::find($id);
            $galleries = Gallery::where('post_id', $id)->get();

            //$parent = array();
            $parent[0]= '';
            foreach ($posts as $value) {
                if($value->id!=$id){$parent[$value['id']]= $value['name'];}
            }
            $view['galleries'] = $galleries;
            $view['parent'] = $parent;
            $view['row'] = $post;

            return View::make('admin.catalog.posts', $view);
        }
    }

    public function postContent($type_id, $id='add')
        {
            $all = Input::all();
             //var_dump($all); die();
            if(!$all['slug']) {$all['slug'] = BaseController::ru2Lat($all['title']);}
            $rules = array(
                'name' => 'required|min:2|max:255',
                'title' => 'required|min:3|max:255',
                'slug'  => 'required|min:4|max:255|alpha_dash',
                //'slug'  => 'required|min:4|max:255|alpha_dash|unique:posts,slug,post_id'.$post_id,
            );
            $validator = Validator::make($all, $rules);
            if ( $validator -> fails() ) {
                return Redirect::to('/admin/content/'.$type_id.'/'.$id)
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error', 'Ошибка');
            }
            if(is_numeric($id))   {
                  $post = Post::find($id);
            }
            else {
                $post = new Post();
            }
            $post->type_id = $all['type_id'];
            $post->name = $all['name'];
            $post->title = $all['title'];
            $post->slug = $all['slug'];

            // $post->preview = $all['preview'];
            $post->text = $all['text'];
            $post->parent = $all['parent'];
            $post->status = isset($all['status'])?true:false;
            // $post->noindex = isset($all['noindex'])?true:false;
            $post->description = $all['description'];
            $post->keywords = $all['keywords'];

            if(isset($all['image'])){
                $full_name = Input::file('image')->getClientOriginalName();
                $filename=$full_name;
                $path = 'upload/image/';
                Input::file('image')->move($path, $filename);
                $post->image = $path.$filename;
            }

            $post->save();

            return Redirect::to('/admin/content/'.$all['type_id'].'/'.$id)
                    ->with('success', 'Изменения сохранены');
        }

    public function postType($type_id)
        {
            $all = Input::all();
            $rules = array(
                'name' => 'required|min:2|max:255',
                'type' => 'required|min:3|max:255',
            );
            $validator = Validator::make($all, $rules);
            if ( $validator -> fails() ) {
                return Redirect::to('/admin/content/'.$type_id)
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error', 'Ошибка');
            }
            if(is_numeric($type_id))   {
                  $post = Type::find($type_id);
            }
            else {
                $post = new Type();
            }
            $post->type = $all['type'];
            $post->name = $all['name'];
            $post->template = $all['template'];
            $post->title = $all['title'];
            $post->text = $all['text'];
            $post->status = isset($all['status'])?true:false;

            $post->save();

            return Redirect::to('/admin/content/'.$type_id)
                    ->with('success', 'Изменения сохранены');
        }

public function postImageGallery($type_id, $post_id, $image_id='add')
        {
            $all = Input::all();
            if($image_id=='add'){
                $rules = array(
                    'image' => 'required',
                );

                $validator = Validator::make($all, $rules);
                if ( $validator -> fails() ) {
                    return Redirect::to('/admin/content/'.$type_id.'/'.$post_id.'/#image-'.$image_id)
                            ->withErrors($validator)
                            ->withInput()
                            ->with('error-img'.$image_id, 'Ошибка');
                }
            }    
            if(!is_numeric($post_id)){return false;}

            if(is_numeric($image_id))   {
                $post = Gallery::find($image_id);
                // var_dump($post); die(); 
            }
            else {
                $post = new Gallery();
                $post->post_id = $post_id;
            }
            $post->text = $all['text'];
            $post->alt = $all['alt'];
            
            // $post->status = isset($all['status'])?true:false;
            if(!empty($all['image'])){
                $full_name = Input::file('image')->getClientOriginalName();
                $filename=$full_name;
                $path = 'upload/gallery/'.$post_id.'/';
                $path_sm = 'upload/gallery/'.$post_id.'/small/';
                if(!is_dir($path_sm)){
                    mkdir($path_sm, 0777, true);
                }
                Input::file('image')->move($path, $filename);
                $post->image = $path.$filename;

                // $img = Image::make($path.$filename)->resize(300, 200);
                Image::make($path.$filename)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path_sm.$filename);
                $post->small_image = $path_sm.$filename;
            }
            $post->save();
            return Redirect::to('/admin/content/'.$type_id.'/'.$post_id.'/#image-'.$image_id)
                    ->with('success-img'.$image_id, 'Изменения сохранены');
        }

// страницы продуктов
    public function getItems($parent_id=''){

        $parents = Post::where('parent', '!=', 0)->lists('name', 'id');
        $items = Product::get();
        $view = array(
            'parent_id' => $parent_id,
            'parents' => $parents,
            'items' => $items,
         );


        return View::make('admin.item.items', $view);
        
    }

    public function getItemAttributeAutocomplete($parent_id=''){

        $term = Input::get('term');

        $results = array();

        $queries = Attribute::where('value', 'LIKE', '%'.$term.'%')
            ->select('value', 'id')
            ->take(5);

        $queries = $queries->get();
        foreach ($queries as $query)
            {
                $results[] = [ 'id' => $query->id, 'value' => $query->value  ];
            }

        return Response::json($results);
        
    }

    public function getItem( $item_id=''){

        $parents = Post::where('parent', '!=', 0)->lists('name', 'id');
        $row = Product::find($item_id);
        $product_attribute = $row->productAttribute;
        // var_dump('<pre>',$product_attribute);
        $attributes = Attribute::lists('value', 'id');
        $images = $row->productImage;        
        // var_dump('<pre>', $images); die();

        $view = array(
            // 'parent_id' => $parent_id,
            'parents' => $parents,
            'row' => $row,
            'attributes' => $attributes,
            'images' => $images,
            'product_attribute' => $product_attribute,
         );


        return View::make('admin.item.item', $view);
        
    }

    public function postItemDescription( $item_id=''){
        $parent_id='';
        $all = Input::all();
         //var_dump($all); die();
        if(!$all['slug']) {$all['slug'] = BaseController::ru2Lat($all['title']);}
        $rules = array(
            'name' => 'required|min:2|max:255',
            'title' => 'required|min:3|max:255',
            'slug'  => 'required|min:4|max:255|alpha_dash',
            //'slug'  => 'required|min:4|max:255|alpha_dash|unique:posts,slug,post_id'.$post_id,
        );
        $validator = Validator::make($all, $rules);
        if ( $validator -> fails() ) {
            return Redirect::to('/admin/item/'.$item_id)
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Ошибка');
        }
        if(is_numeric($item_id))   {
              $post = Product::find($item_id);
        }
        else {
            $post = new Product();
        }
        $post->name = $all['name'];
        $post->title = $all['title'];
        $post->slug = $all['slug'];

        $post->description = $all['description'];
        $post->parent = $all['parent'];
        $post->status = isset($all['status'])?true:false;
        // $post->noindex = isset($all['noindex'])?true:false;
        $post->meta_description = $all['meta_description'];
        $post->meta_keywords = $all['meta_keywords'];

        $post->save();

        return Redirect::to('/admin/item/'.$item_id);
    }

    public function postItemAttributes($item_id=''){
        if ( $item_id=='' ) {
            return Redirect::back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Сначала заполните общие параметры');
        }

        $all = Input::all();

        foreach ($all['attr'] as $key => $attr) {
            $post = ProductAttribute::where('product_id', $item_id)->where('attribute_id', $attr["attr_id"])->first();
            if(empty($post)){
                $post = new ProductAttribute();
                $post->product_id = $item_id;
            }
            $post->attribute_id = $attr["attr_id"];
            $post->value = $attr["value"];
            $post->save();            
        }

        return Redirect::to('/admin/item/'.$item_id);
    }

    public function postItemImage( $product_id, $image_id='add')
        {
            $all = Input::all();
            if($image_id=='add'){
                $rules = array(
                    'image' => 'required',
                );

                $validator = Validator::make($all, $rules);
                if ( $validator -> fails() ) {
                    return Redirect::to('/admin/item/'.$product_id.'/#image-'.$image_id)
                            ->withErrors($validator)
                            ->withInput()
                            ->with('error-img'.$image_id, 'Ошибка');
                }
            }    
            if(!is_numeric($product_id)){return false;}

            if(is_numeric($image_id))   {
                $post = ProductImage::find($image_id);
                // var_dump($post); die(); 
            }
            else {
                $post = new ProductImage();
                $post->product_id = $product_id;
            }
            $post->text = $all['text'];
            $post->alt = $all['alt'];
            
            // $post->status = isset($all['status'])?true:false;
            if(!empty($all['image'])){
                $full_name = Input::file('image')->getClientOriginalName();
                $filename=$full_name;
                $path = 'upload/product/'.$product_id.'/';
                $path_sm = 'upload/product/'.$product_id.'/small/';
                if(!is_dir($path_sm)){
                    mkdir($path_sm, 0777, true);
                }
                Input::file('image')->move($path, $filename);
                $post->image = $path.$filename;

                // $img = Image::make($path.$filename)->resize(300, 200);
                Image::make($path.$filename)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path_sm.$filename);
                $post->small_image = $path_sm.$filename;
            }
            $post->save();
            return Redirect::to('/admin/item/'.$product_id.'/#image-'.$image_id)
                    ->with('success-img'.$image_id, 'Изменения сохранены');
        }

// атрибуты

    public function getAttribute( $attr_id=''){

        $attributes = Attribute::get();
        $row = Attribute::find($attr_id);   

        $view = array(
            'row' => $row,
            'attributes' => $attributes,
         );


        return View::make('admin.item.attribute', $view);
        
    }    

    public function postAttribute( $attr_id=''){
        $all = Input::all();
        $rules = array(
            'name' => 'required|min:2|max:255',
            'value' => 'required|min:2|max:255',
        );
        $validator = Validator::make($all, $rules);
        if ( $validator -> fails() ) {
            return Redirect::to('/admin/attribute/'.$attr_id)
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Ошибка');
        }
        if(is_numeric($attr_id))   {
              $post = Attribute::find($attr_id);
        }
        else {
            $post = new Attribute();
        }
        $post->name = $all['name'];
        $post->value = $all['value'];
        $post->group = $all['group'];
        $post->description = $all['description'];

        $post->save();

        return Redirect::to('/admin/attribute/'.$attr_id);
    }

//удаление страниц
    public function getDelete($type, $type_id, $id){

        switch ($type){
            case 'page':
                $posts = Post::where('type_id', '=', $type_id)->where('id', '=', $id)->delete();
                $redir = '/admin/content/'.$type_id;
                break;
            case 'type':
                $posts = Type::find($type_id)->delete();
                $redir = '/admin/content/';
                break;                
            case 'slide':
                $slide = Slider::find($id)->delete();
                $redir = '/admin/slider';
                break;
            case 'user':
                $slide = User::find($id)->delete();
                $redir = '/admin/user';
                break;
            case 'image':
                $slide = Gallery::find($id)->first();
                unlink($slide->image);
                unlink($slide->small_image);
                $slide->delete();
                // $redir = '/admin/content/'.$type_id;
                return Redirect::back();
                break; 
            case 'attribut_product':
                $post = ProductAttribute::find($id)->delete(); 
                // var_dump($post); die();
                return;
                break;
            case 'attribute':
                $post = Attribute::find($id)->delete(); 
                $redir = '/admin/attribute';
                break;    
        }

        return Redirect::to($redir);

    }

//настройки
    public function getSettings()
        {
            $settings = Setting::get();

            $view = array(
                'settings' => $settings,
            );
            return View::make('admin.settings', $view);
        }

    public function postSettings($news_id='')
        {
            $settings = Input::all();

            foreach($settings as $key=>$setting) {
                if($key[0]!='_'){
                    $field_ru = Setting::where('name', '=', $key)->first();
                    $field_ru->value = $setting;
                    $field_ru->save();
                }
            }
            return Redirect::to('/admin/settings');
        }

//пользователи
    public function getUser($id='')
        {
            $users = User::get();
            $user = User::find($id);

            $view = array(
                'users' => $users,
                'row' => $user,
             );

            return View::make('admin.users', $view);
        }

    public function postUser($id)
        {
            $all = Input::all();

            $rules = array(
                'name' => 'required|min:2|max:255',
                'email'  => 'required|email',

            );
            $validator = Validator::make($all, $rules);
            if ( $validator -> fails() ) {
                return Redirect::to('/admin/user/'.$id)
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error', 'Ошибка');
            }
            if($id)   {
                  $user = User::find($id);
            }
            else {
                $user = new User();
            }

            $user->name = $all['name'];
            $user->email = $all['email'];
            $user->isActive = $all['isActive'];
            $user->save();

            return Redirect::to('/admin/user/'.$id)
                    ->with('success', 'Изменения сохранены');
        }

        //карта сайта

        public function getCreateSitemap(){
            $urlroot=Config::get('app.url');
            $types = Type::where('status', 1)->get(array('type','updated_at', 'id'));
            $pages = Post::where('status', 1)->get(array('slug','updated_at', 'type_id'));
            // $project = Project::get(array('slug', 'updated_at'));

             // var_dump($urlroot); die();
            $xml=new DomDocument('1.0','utf-8');

            $urlset = $xml->createElement('urlset');
            $urlset -> setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

            foreach($types as $type){

                    $url = $xml->createElement('url');
                    $urlset->appendChild($url);

                    $loc = $xml->createElement('loc');
                    $url->appendChild($loc);

                    $loc->appendChild($text = $xml->createTextNode($urlroot.'/'.$type->type));

                    $lastmod = $xml->createElement('lastmod');
                    $url->appendChild($lastmod);

                    $lastmod->appendChild($xml->createTextNode(date('Y-m-d', strtotime($type->updated_at))));

                foreach($pages as $post){
                    if($post->type_id == $type->id){

                        $url = $xml->createElement('url');
                        $urlset->appendChild($url);

                        $loc = $xml->createElement('loc');
                        $url->appendChild($loc);

                        $loc->appendChild($text = $xml->createTextNode($urlroot.'/'.$type->type.'/'.$post->slug));

                        $lastmod = $xml->createElement('lastmod');
                        $url->appendChild($lastmod);

                        $lastmod->appendChild($xml->createTextNode(date('Y-m-d', strtotime($post->updated_at))));
                    }
                }
            }

            $xml->appendChild($urlset);
            $xml->formatOutput = true;
            $xml->save('sitemap.xml');
            //$xml->saveXML();

            if (!@fopen('sitemap.xml', "r")) {
                return Redirect::back()->with('error', 'ошибка при обновлении файла sitemap.xml');
            }
            return Redirect::back()->with('success', 'файл sitemap.xml обновлен');
            // return Response::download('sitemap.xml');

        }

}
