jQuery(document).ready(function($) {
  // Search recipes
  $('.search-form-recipes').submit(function(event) {
    event.preventDefault();

    let formData = $(this).serialize();

    $.ajax({
      type: 'POST',
      url: ajax_object.ajax_url,
      data: formData + '&action=recipe_search',
      success: function(response) {
        $('.searching').html(response);
      }
    });
  });


  // Filter recipes for category
  let paged = 1;

  $('#recipes-filtration .category-checkbox').change(function() {
      paged = 1;
      loadRecipes();

      if ($(this).is(':checked')) {
        $(this).closest('.category-filter__label').addClass('category-filter__label_checked');
      } else {
        $(this).closest('.category-filter__label').removeClass('category-filter__label_checked');
      }
  });

  function loadRecipes(page) {
    let categoryValues = [];
    $('#recipes-filtration .category-checkbox:checked').each(function() {
      categoryValues.push($(this).val());
    });

    $.ajax({
      type: 'POST',
      url: ajax_object.ajax_url,
      data: {
        action: 'load_recipes_by_category',
        category_filter_values: categoryValues,
        paged: page,
      },
      success: function(response) {
        $('#recipes-filtration .filtration__list').html(response);
      }
    });

    $(document).on('click', '#recipes-filtration .pagination a', function(e) {
      e.preventDefault();
      let page = $(this).attr('href').split('paged=')[1];
      loadRecipes(page);
    });
  }

  loadRecipes();





  // Open-close recipe-card
  $(document).on('click', '.recipe-card__button', function(e) {
    e.preventDefault();
    let button = $(this),
        card = button.closest('.recipe-card'),
        cardContent = card.find('.recipe-card__content_second');
    cardContent.slideToggle();
    button.toggleClass('recipe-card__button_active')
    card.toggleClass('recipe-card_active')
  });
});
