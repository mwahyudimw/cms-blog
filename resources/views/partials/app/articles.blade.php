<div class="columns is-multiline">
    @foreach ($articles as $article)
        <div class="column is-12">
            <div class="columns is-vcentered">
                <div class="column is-9">
                    <h2 class="title"><a class="has-text-grey-dark" href="{{ $article->link }}">{{ $article->title }}</a></h2>
                </div>
                <div class="column is-3 has-text-right-desktop">
                    <a href="{{ $article->category->link }}" class="button is-default">{{ $article->category->title }}</a>
                </div>
            </div>
            <div class="level"></div>
            @php
                $output = preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $article->content, $matches);
                $first_img = $matches[1][0] ?? asset("/img/default.jpg");
            @endphp
            <div class="columns is-vcentered">
                <div class="column is-3">
                    <img src="{{ $first_img }}" alt="{{ $first_img }}" srcset="{{ $first_img }}">
                </div>
                <div class="content column is-9">
                    <p>{{ getNWords($article->content, 50) }}</p>
                </div>
            </div>
            <div class="columns is-vcentered">
                <div class="column is-9">
                    <a class="button is-link" href="{{ $article->link }}">{{ __('app.read_more') }}</a>
                </div>
                <div class="column is-3 has-text-right-desktop">
                    <p class="has-text-grey">{{ $article->localized_published_at }}</p>
                </div>
            </div>
        </div>
    @endforeach
    @if ($articles->total() > $articles->count())
        <div class="column is-12">
            {!! $articles->appends(request()->except('page'))->links() !!}
        </div>
    @endif
</div>

@push('scripts')
    <script type="text/javascript">
        $('ul.pagination-list').hide();
        $(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<img class="center-block" src="/images/loading.gif" alt="Loading..." />',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });
        });
    </script>
@endpush