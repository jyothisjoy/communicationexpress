/**
 * Compatible Accessories — Admin UI
 *
 * Handles the product search, add, and remove interactions
 * on the product edit screen meta box.
 *
 * @package CommExpress
 */

jQuery(document).ready(function ($) {

    var $search      = $('#comm-express-acc-search');
    var $results     = $('#comm-express-acc-results');
    var $list        = $('#comm-express-acc-list');
    var $emptyNote   = $('#comm-express-acc-empty');
    var currentPostId = $('#post_ID').val();
    var searchTimer;

    if (!$search.length) return;

    // -------------------------------------------------------------------------
    // Live search with 300ms debounce
    // -------------------------------------------------------------------------
    $search.on('keyup', function () {
        clearTimeout(searchTimer);
        var term = $.trim($(this).val());

        if (term.length < 2) {
            $results.hide().empty();
            return;
        }

        searchTimer = setTimeout(function () {
            $.ajax({
                url:      commExpressAccessories.ajaxurl,
                type:     'GET',
                dataType: 'json',
                data: {
                    action:  'comm_express_search_accessories',
                    nonce:   commExpressAccessories.nonce,
                    term:    term,
                    exclude: currentPostId
                },
                success: function (response) {
                    $results.empty();

                    if (!response.success || !response.data.length) {
                        $results.append('<li style="padding:8px; color:#999;">No products found.</li>');
                        $results.show();
                        return;
                    }

                    $.each(response.data, function (i, product) {
                        // Skip products already in the list
                        if ($list.find('li[data-id="' + product.id + '"]').length) {
                            return;
                        }

                        var thumbHtml = product.thumb
                            ? '<img src="' + product.thumb + '" width="30" height="30" style="object-fit:cover; margin-right:6px; flex-shrink:0;">'
                            : '<span style="display:inline-block;width:30px;height:30px;background:#eee;margin-right:6px;flex-shrink:0;"></span>';

                        var skuHtml = product.sku
                            ? ' <em style="color:#999; font-size:0.85em;">(' + product.sku + ')</em>'
                            : '';

                        $results.append(
                            '<li data-id="' + product.id + '" ' +
                            'data-title="' + $('<div>').text(product.title).html() + '" ' +
                            'data-thumb="' + product.thumb + '" ' +
                            'style="padding:8px; cursor:pointer; display:flex; align-items:center; border-bottom:1px solid #eee;">' +
                            thumbHtml +
                            '<span>' + product.title + skuHtml + '</span>' +
                            '</li>'
                        );
                    });

                    $results.show();
                }
            });
        }, 300);
    });

    // -------------------------------------------------------------------------
    // Click a search result to add the accessory
    // -------------------------------------------------------------------------
    $results.on('click', 'li[data-id]', function () {
        var $item  = $(this);
        var id     = $item.data('id');
        var title  = $item.find('span').clone().children('em').remove().end().text().trim();
        var sku    = $item.find('em').text().replace(/[()]/g, '').trim();
        var thumb  = $item.data('thumb');

        var thumbHtml = thumb
            ? '<img src="' + thumb + '" width="40" height="40" style="object-fit:cover; flex-shrink:0;">'
            : '<span style="display:inline-block;width:40px;height:40px;background:#eee;flex-shrink:0;"></span>';

        var skuHtml = sku
            ? ' <em style="color:#999; font-size:0.85em;">(' + sku + ')</em>'
            : '';

        $list.append(
            '<li data-id="' + id + '" ' +
            'style="padding:6px 0; border-bottom:1px solid #eee; display:flex; align-items:center; gap:8px;">' +
            thumbHtml +
            '<span>' + title + skuHtml + '</span>' +
            '<button type="button" class="button comm-express-acc-remove" style="margin-left:auto;">Remove</button>' +
            '<input type="hidden" name="comm_express_accessories[]" value="' + id + '">' +
            '</li>'
        );

        // Hide the "no accessories" note once one is added
        $emptyNote.hide();

        $results.hide().empty();
        $search.val('');
    });

    // -------------------------------------------------------------------------
    // Remove button (delegated — works for pre-rendered and dynamic items)
    // -------------------------------------------------------------------------
    $list.on('click', '.comm-express-acc-remove', function () {
        $(this).closest('li').remove();

        if (!$list.find('li').length) {
            $emptyNote.show();
        }
    });

    // -------------------------------------------------------------------------
    // Close dropdown when clicking outside the meta box wrap
    // -------------------------------------------------------------------------
    $(document).on('click', function (e) {
        if (!$(e.target).closest('#comm-express-accessories-wrap').length) {
            $results.hide();
        }
    });

});
