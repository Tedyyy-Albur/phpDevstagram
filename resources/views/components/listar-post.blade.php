<div>
    @if ($posts->count())

    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            
        @foreach ($posts as $item)
        
        <div class="">
            <a href="{{ route('posts.show', [ 'post' => $item, 'user' => $item->user ]) }}">
                <img src="{{ asset('uploads').'/'. $item->imagen }}" alt="Imagen del post {{ $item->titulo }}">
            </a>
        </div>
        
        @endforeach
    </div>
    <div class="mt-10">
        {{ $posts->links() }}
    </div>
        
    @else
        <p class="text-center">No Hay posts</p>
    @endif
</div>