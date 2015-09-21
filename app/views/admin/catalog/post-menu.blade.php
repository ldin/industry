    <h3><i class="glyphicon glyphicon-menu-hamburger"></i> {{!empty($type_page[$type_id])?$type_page[$type_id]:''}} <small><a href="/admin/content/{{$type_id}}">(ред)</a></small></h3>
    @if(isset($posts) )
        <ul class="nav menu">
            @foreach ($posts as $key => $post)
                <li class="dropdown  {{ (Request::is('admin/content/'.$post->type_id.'/'.$post->id)) ? 'active' : '' }}" >
                    {{ HTML::link('admin/content/'.$post->type_id.'/'.$post->id, $post->name) }}
                    <ul  id='sortable-{{$key}}' class="my-dropdown-menu">
                        @if(isset($posts_child))
                            @foreach($posts_child as $post2)
                                @if($post2->parent == $post->id)

                                    <li id='{{$post2->id}}' class="{{ (Request::is('admin/content/'.$post2->type_id.'/'.$post2->id)) ? 'active' : '' }}">
                                        {{ HTML::link('admin/content/'.$post2->type_id.'/'.$post2->id, $post2->name) }}
                                        <!-- <i class="glyphicon glyphicon-resize-vertical order"></i> -->
<!--                                         @if(isset($row['id']) &&( $post2->id == $row['id'] || $post2->id == $row['id']))

                                        @endif -->
                                    </li>
                                @endif
                            @endforeach
                        @endif
                     </ul>
                </li>
            @endforeach
        </ul>
    @endif
    <p><br>
        <?php echo HTML::decode(HTML::link('/admin/content/'.$type_id.'/add', '<i class="glyphicon glyphicon-plus"></i>&nbsp;Добавить категорию', array('class'=>'addNews'))); ?>
        <?php echo HTML::decode(HTML::link('/admin/content/'.$type_id.'/add', '<i class="glyphicon glyphicon-plus"></i>&nbsp;Добавить товар', array('class'=>'addNews'))); ?>
    
    </p>
