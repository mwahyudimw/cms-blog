<nav class="navbar is-light">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ route('root') }}">
                <img src="{{ asset(config('settings.logo')) }}" alt="{{ config('settings.site_title') }}">
            </a>
            <div id="toggle-menu" class="navbar-burger burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div id="menu" class="navbar-menu">
            <div class="navbar-start">
                @foreach (getMenu() as $p)
                    @if ($p->children->count() > 0)
                        <div class="navbar-item has-dropdown is-hoverable">
                            <div class="navbar-link">
                                <a class="navbar-item {{ active($p) }}" href="{{ $p->link }}">
                                    {{ $p->title }}
                                </a>
                            </div>
                            <div class="navbar-dropdown">
                                @foreach ($p->children as $child)
                                    <a class="navbar-item {{ active($child) }}" href="{{ $child->link }}">
                                        {{ $child->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a class="navbar-item" href="{{ $p->link }}">
                            {{ $p->title }}
                        </a>
                    @endif
                @endforeach
            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="field is-grouped">
                        <form action="{{ route('search') }}" method="get">
                            <div class="field" style="justify-content: center; display: flex">
                                <p class="control">
                                    <input class="input" type="text" name="search">
                                </p>
                                <p class="control">
                                    <button type="submit" class="button is-info is-fullwidth">{{ __('Search') }}</button> 
                                </p>
                            </div>
                        </form>
                        <div class="navbar-item has-dropdown is-hoverable">
                            <form action="{{ route('byCategory') }}" method="get">
                                <div class="field">
                                    <div class="control">
                                        <div class="select">
                                            <select name="category" onchange="this.form.submit()">
                                                @php
                                                    use App\Models\Category;
                                                    $category = Category::limit(5)->get();
                                                @endphp
                                                <option disabled selected>By Category</option>
                                                @forelse ($category as $value)
                                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                @empty
                                                    <option>None</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        {{-- <div class="navbar-link">
                            <spaisset>Category</spaisset($valueOnly) ? $value :  n>
                        </div> --}}

                        {{-- <p class="control">
                            <a target="_blank" rel="noopener noreferrer" href="@yield('facebook')" class="button button-facebook">
                                <span class="icon">{!! icon('facebook') !!}</span>
                                <span>{{ __('app.buttons.share') }}</span>
                            </a>
                        </p>
                        <p class="control">
                            <a target="_blank" rel="noopener noreferrer" href="@yield('twitter')" class="button button-twitter">
                                <span class="icon">{!! icon('twitter') !!}</span>
                                <span>{{ __('app.buttons.tweet') }}</span>
                            </a>
                        </p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
