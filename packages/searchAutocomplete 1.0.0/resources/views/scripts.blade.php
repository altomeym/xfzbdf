<script type="text/javascript">
  // Product Search
  $('#autoSearchInput, #autoSearchInput2').on('keyup', function(e) {
    let min_char = "{{ get_search_autocomplete_config()['min_char'] }}";
    let showResult = $(this).parent().parent().find("#autoSearchResult");
    let query = $(this).val();

    if (query.length < Number(min_char)) {
      showResult.html("<li>{{ trans('theme.type_min_char', ['min' => get_search_autocomplete_config()['min_char']]) }}</li>");
      return;
    }

    showResult.html('<li>{{ trans('theme.searching') }}</li>');

    $.ajax({
      data: "q=" + query,
      url: "{{ route('search.autocomplete') }}",
      success: function(results) {
        showResult.html(results);
      }
    });
  });
  //End product Seach
</script>
