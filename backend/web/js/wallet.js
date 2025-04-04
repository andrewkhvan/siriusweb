(function ($) {
    $(function () {

        const walletModal = document.getElementById('modal-wallet');

        if (walletModal) {
            walletModal.addEventListener('show.bs.modal', event => {
                
                const modalBody = walletModal.querySelector('.modal-body')

                modalBody.innerHTML = '<p class="text-center fs-1 my-4"><i class="bx bx-loader bx-spin"></i></p>'

                $.ajax({
                    "method": "get",
                    "url": "/cabinet/wallet-update",
                }).done(function (data) {
                    modalBody.innerHTML = data
                });

            })
        }
    })
})(jQuery);
