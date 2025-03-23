<div class="search-container">
    <form action="{{ $route }}" method="GET">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search" placeholder="Search..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-outline-primary">🔍</button>
    </form>
</div>
