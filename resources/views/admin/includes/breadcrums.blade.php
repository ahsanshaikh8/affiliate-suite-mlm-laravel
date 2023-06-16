<ol class="breadcrumb float-sm-right">
    <?php $segments = ''; 
    ?>
    
    @foreach(Request::segments() as $segment)
        <?php 
            $segments .= '/'.$segment; 
        ?>
        <li class="breadcrumb-item {{ (Request::segments()[count(Request::segments())-1] == $segment)?'active':'' }}">
            <a href="{{ ($segments == '/admin')?'/admin/home':$segments; }}">{{ ($segment == 'admin')?'Home':ucwords($segment)}}</a>
        </li>

    @endforeach
</ol>