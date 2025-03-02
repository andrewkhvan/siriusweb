(function ($) {
    $(function () {

        const viewOpModal = document.getElementById('modal-view');

        if (viewOpModal) {
            viewOpModal.addEventListener('show.bs.modal', event => {
                
                const button = event.relatedTarget
                const optitle = button.getAttribute('data-bs-optitle')

                //Update the modal's content
                const modalTitle = viewOpModal.querySelector('#op-num')
                modalTitle.textContent = `#${optitle}`

                const modalBody = viewOpModal.querySelector('#op-body')
                modalBody.innerHTML = '<div class="d-flex align-items-center" style="min-height:450px;"><div class="flex-grow-1 text-center"><i class="mdi mdi-loading mdi-spin mdi-36px"></i></div></div>'

                $.ajax({
                    "url": "/user/operation-view",
                    "method": "post",
                    "data": {"docnum": optitle}

                }).done(function (data) {
                    const modalBody = viewOpModal.querySelector('.modal-body')
                    modalBody.innerHTML = data
                })
            })
        }
    })
})(jQuery);