<form action="{{ route('search') }}" method="GET">
  <div class="search-form">
    <div class="actions">
      <div class="input-group">
        <input type="search" placeholder="Type your keyboard" name="name">
        <button class="btn" type="submit">
          <i class="op-icon search"></i>
        </button>
      </div>
      <button class="btn" type="button"
      onclick="document.querySelector('.search-filters-form').classList.toggle('active')">
      <i class="op-icon tweak"></i>
    </button>
  </div>
  <div class="search-filters-form">
    <h5>Apply Filter To Search:</h5>
    <label for="show_expired">
      <input type="checkbox" name="show_expired" value="false" id="show_expired">
      Show expired surveys
    </label>
    <label for="search_in_choices" style="margin-bottom: 10px;">
      <input type="checkbox" name="search_in_choices" value="false" id="search_in_choices">
      Search in choices
    </label>

    <h5>Filter By Date:</h5>
    <div style="display: flex; justify-content: space-between;">
      <label for="date_from">
        From:
        <input type="date" name="date_from" id="date_from">
      </label>
      <label for="date_to">
        To:
        <input type="date" name="date_to" id="date_to">
      </label>
    </div>
  </div>
</div>
</form>
