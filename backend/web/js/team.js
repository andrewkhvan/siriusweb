(function ($) {
   $(function () {

        $('#team-group').on('click', '.toggle-subgroup', function () {
            var btn = $(this);
            var icon = btn.find('i.mdi');
            icon.toggleClass('mdi-plus-box-outline');
            icon.toggleClass('mdi-minus-box-outline');

            if (btn.hasClass('subgroup-loaded')) {
                return;
            }

            var div_target = btn.attr('data-bs-target');

            $.ajax({
                'method': 'POST',
                'url': '/cabinet/team-subgroup',
                'data': {'partner_id': btn.attr('data-id')}
            }).done(function (data) {
                $(div_target).html(data);
                btn.addClass('subgroup-loaded');
            });
        })

        $('#ref-link').click(function (e) {
            e.preventDefault();
            navigator.clipboard.writeText($(this).attr('data-copy-text'));
            alert("Copied to clipboard");
        });
        
    })
})(jQuery);
