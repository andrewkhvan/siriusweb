(function ($) {
    $(function () {

        const investModal = document.getElementById('modal-invest');

        if (investModal) {
            investModal.addEventListener('show.bs.modal', event => {
                
                const button = event.relatedTarget;
                const invId = button.getAttribute('data-inv-id')
                const modalBody = investModal.querySelector('.modal-body')

                modalBody.innerHTML = '<p class="text-center fs-1 my-4"><i class="bx bx-loader bx-spin"></i></p>'

                $.ajax({
                    "method": "get",
                    "url": "/cabinet/invest-open",
                    "data": {"id":invId}
                }).done(function (data) {
                    modalBody.innerHTML = data
                });

            })
        }
    })
})(jQuery);