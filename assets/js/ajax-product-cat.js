jQuery(document).ready(function ($) {
    // Load initial products
    var activeTab = $('#subcategoryTabsContent .tab-pane.active');
    load_products_for_tab(activeTab, 1);

    // Handle tab click
    $('#subcategoryTabs a').on('click', function (e) {
        e.preventDefault();
        var tab_id = $(this).attr('href').split('#')[1];
        var tab = $('#' + tab_id);

        load_products_for_tab(tab,1);
    });

      // Handle pagination click
      $(document).on('click', '.pagination_1 a', function (e) {
        e.preventDefault();

        var href = $(this).attr('href');
        var pageMatch = href.match(/page\/(\d+)\//);
        var page = pageMatch ? pageMatch[1] : 1;
        // alert(page);
        var category_id = $(this).closest('.tab-pane').find('.product-list').data('category-id');
        var tab = $(this).closest('.tab-pane');

        load_products_for_tab(tab, page);
    });

    // Load products for a tab
    function load_products_for_tab(tab, page = 1) {
        var category_id = tab.find('.product-list').data('category-id');
// alert(category_id);
        $.ajax({
            url: ajaxpagination.ajaxurl,
            type: 'POST',
            data: {
                action: 'load_more_products',
                page: page,
                category_id: category_id
            },
            success: function (response) {
                tab.find('.product-list').html(response.content);
                tab.find('.pagination-container').html(response.pagination);
            },
            error: function () {
                console.log('Failed to load products.');
            }
        });
    }
});
